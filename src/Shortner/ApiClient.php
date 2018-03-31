<?php

namespace Shortner;

use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Shortner\API\CreateResponse;
use Shortner\API\Link;
use Shortner\API\LinkResponse;
use Shortner\API\NewLink;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Shortner\API\Reorder;
use Shortner\Exception\ResponseException;

/**
 * Class ApiClient
 * @package Shortner
 */
class ApiClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $hostname;

    private $protocol = 'https';

    /**
     * ApiClient constructor.
     * @param string $hostname
     * @param string $token
     */
    public function __construct($hostname, $token, $basePath = '/api/', $protocol = 'https')
    {
        $this->hostname = $hostname;
        $this->basePath = $basePath;
        $this->protocol = $protocol;
        $this->token = $token;
        $this->client = new Client();
        $this->serializer = SerializerBuilder::create()->build();
        //trick jmsserializer into loading these classes :)
        new ExclusionPolicy(['value' => 'all']);
        new Expose();
        new Type();
        new SerializedName(['value' => '']);
        new CreateResponse();
        new Link();
        new Reorder();
    }

    /**
     * @param Client $client
     */
    public function setGuzzleClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array  $queryArguments
     * @param string $body
     * @param null   $hostname
     * @param null   $token
     * @return Response
     * @throws ResponseException
     */
    private function call($method, $endpoint, array $queryArguments = [], $body, $hostname = null, $token = null)
    {
        $hostname = (is_null($hostname) ? $this->hostname : $hostname);
        $token = (is_null($token) ? $this->token : $token);
        $url = $this->protocol . '://' . $hostname . $this->basePath . $endpoint . '?' . http_build_query($queryArguments);
        $options = [
            "headers" => [
                "token" => $token,
                "content-type" => "application/json"
            ],
            "body" => $body
        ];
        try {
            $response = $this->client->request($method, $url, $options);
        } catch (ClientException $e) {
            return $this->handleErrorResponse($e->getResponse());
        } catch (ServerException $e) {
            return $this->handleErrorResponse($e->getResponse());
        } catch (BadResponseException $e) {
            return $this->handleErrorResponse($e->getResponse());
        }
        return $response;
    }

    /**
     * @return LinkResponse
     * @throws ResponseException
     */
    public function getLink($shortcode, $hostname = null, $token = null)
    {
        $response = $this->call('GET', 'link/'.$shortcode, [], null,$hostname,$token);
        if (!in_array($response->getStatusCode(), [200, 201, 202])) {
            return $this->handleErrorResponse($response);
        }
        $body = $response->getBody()->getContents();
        $responseObj = $this->serializer->deserialize($body, 'Shortner\API\LinkResponse', 'json');
        /**
         * @var CreateResponse $responseObj
         */
        if ($responseObj->isSuccess()) {
            return $responseObj;
        } else {
            return $this->handleErrorResponse($response);
        }
    }
    /**
     * @return LinkResponse
     * @throws ResponseException
     */
    public function reOrder($shortcode,array $order, $hostname = null, $token = null)
    {
        $reorder = new Reorder();
        $reorder->setOrder($order);
        $body = $this->serializer->serialize($reorder, 'json');
        $response = $this->call('POST', 'collection/order/'.$shortcode, [], $body,$hostname,$token);
        if (!in_array($response->getStatusCode(), [200, 201, 202])) {
            return $this->handleErrorResponse($response);
        }
        $body = $response->getBody()->getContents();
        $responseObj = $this->serializer->deserialize($body, 'Shortner\API\LinkResponse', 'json');
        /**
         * @var CreateResponse $responseObj
         */
        if ($responseObj->isSuccess()) {
            return $responseObj;
        } else {
            return $this->handleErrorResponse($response);
        }
    }
    /**
     * @param NewLink     $newLink
     * @param string|null $hostname
     * @param string|null $token
     * @return CreateResponse
     * @throws ResponseException
     */
    public function createLink(NewLink $newLink, $hostname = null, $token = null)
    {
        $body = $this->serializer->serialize($newLink, 'json');
        $response = $this->call('POST', 'link', [], $body,$hostname,$token);
        $body = $response->getBody()->getContents();
        if (!in_array($response->getStatusCode(), [200, 201, 202])) {
            return $this->handleErrorResponse($response);
        }
        $responseObj = $this->serializer->deserialize($body, 'Shortner\API\CreateResponse', 'json');
        /**
         * @var CreateResponse $responseObj
         */
        if ($responseObj->isSuccess()) {
            return $responseObj;
        } else {
            return $this->handleErrorResponse($response);
        }
    }

    /**
     * @param Response $response
     * @throws ResponseException
     */
    private function handleErrorResponse(Response $response)
    {
        $jsonData = json_decode($response->getBody()->getContents(), true);
        if (is_null($jsonData)) {
            throw new ResponseException($response->getReasonPhrase(), $response->getStatusCode());
        }
        if (isset($jsonData['message'])) {
            throw new ResponseException($jsonData['message'], $response->getStatusCode());
        }
        if (isset($jsonData['error'])) {
            throw new ResponseException($jsonData['error'], $response->getStatusCode());
        }
        throw new ResponseException($response->getReasonPhrase(), $response->getStatusCode());
    }
}