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
class Reorder
{

    /**
     * @var string[]
     * @Type("array<string>")
     * @Expose
     */
    private $order=[];

    /**
     * @return string[]
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string[] $order
     * @return Reorder
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }
}