<?php

namespace Shortner\API;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
/**
 * Class NewLink
 * @package Shortner\API
 * @ExclusionPolicy("all")
 */
class NewLink
{
    const TYPE_COLLECTION='collection';
    const TYPE_LINK='link';
    const WARNING_NSFW='nsfw';
    /**
     * @var string[]
     * @Type("array<string>")
     * @Expose
     */
    private $warnings=[];

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    private $description="";

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    private $type=Link::TYPE_LINK;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    private $custom;

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
    private $collection;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    private $podcast;

    /**
     * @return string[]
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @param string[] $warnings
     * @return NewLink
     */
    public function setWarnings(array $warnings)
    {
        $this->warnings = $warnings;
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
     * @return NewLink
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return NewLink
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * @param string $custom
     * @return NewLink
     */
    public function setCustom($custom)
    {
        $this->custom = $custom;
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
     * @return NewLink
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param string $collection
     * @return NewLink
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * @return string
     */
    public function getPodcast()
    {
        return $this->podcast;
    }

    /**
     * @param string $podcast
     * @return NewLink
     */
    public function setPodcast($podcast)
    {
        $this->podcast = $podcast;
        return $this;
    }



}