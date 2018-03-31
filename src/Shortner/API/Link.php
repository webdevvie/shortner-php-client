<?php

namespace Shortner\API;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Class Link
 * @package Shortner\API
 * @ExclusionPolicy("all")
 */
class Link
{
    const TYPE_COLLECTION='collection';
    const TYPE_LINK='link';
    const WARNING_NSFW='nsfw';
    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    private $shortCode;
    /**
     * @var string[]
     * @Type("array<string>")
     * @Expose
     */
    private $warnings;
    /**
     * @var string[]
     * @Type("array<string>")
     * @Expose
     */
    private $order;
    /**
     * @var integer
     * @Type("integer")
     * @Expose
     */
    private $hits;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    private $description;
    /**
     * @var string
     * @Type("string")
     * @SerializedName("realShortCode")
     * @Expose
     */
    private $realShortCode;
    /**
     * @var string
     * @Type("string")
     * @SerializedName("customCode")
     * @Expose
     */
    private $customCode;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    private $type;
    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    private $link;
    /**
     * @var string
     * @Type("string")
     * @SerializedName("customLink")
     * @Expose
     */
    private $customLink;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    private $url;
    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    private $detailLink;

    /**
     * @var Link[]
     * @Type("array<Shortner\API\Link>")
     * @Expose
     */
    private $links;

    /**
     * @return string
     */
    public function getShortCode()
    {
        return $this->shortCode;
    }

    /**
     * @param string $shortCode
     * @return Link
     */
    public function setShortCode($shortCode)
    {
        $this->shortCode = $shortCode;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @param string[] $warnings
     * @return Link
     */
    public function setWarnings($warnings)
    {
        $this->warnings = $warnings;
        return $this;
    }

    /**
     * @return int
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * @param int $hits
     * @return Link
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Link
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getRealShortCode()
    {
        return $this->realShortCode;
    }

    /**
     * @param string $realShortCode
     * @return Link
     */
    public function setRealShortCode($realShortCode)
    {
        $this->realShortCode = $realShortCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomCode()
    {
        return $this->customCode;
    }

    /**
     * @param string $customCode
     * @return Link
     */
    public function setCustomCode($customCode)
    {
        $this->customCode = $customCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Link
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return Link
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomLink()
    {
        return $this->customLink;
    }

    /**
     * @param string $customLink
     * @return Link
     */
    public function setCustomLink($customLink)
    {
        $this->customLink = $customLink;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Link
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getDetailLink()
    {
        return $this->detailLink;
    }

    /**
     * @param string $detailLink
     * @return Link
     */
    public function setDetailLink($detailLink)
    {
        $this->detailLink = $detailLink;
        return $this;
    }

    /**
     * @return Link[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param Link[] $links
     * @return Link
     */
    public function setLinks($links)
    {
        $this->links = $links;
        return $this;
    }
}