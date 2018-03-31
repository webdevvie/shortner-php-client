<?php

namespace Shortner\API;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Shortner\API\Link;

/**
 * Class Link
 * @package Shortner\API
 * @ExclusionPolicy("all")
 */
class CreateResponse
{
    /**
     * @var boolean
     * @Type("boolean")
     * @Expose
     */
    private $success=false;

    /**
     * @var Link
     * @Type("Shortner\API\Link")
     * @Expose
     */
    private $link;

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     * @return CreateResponse
     */
    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return \Shortner\API\Link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param \Shortner\API\Link $link
     * @return CreateResponse
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

}