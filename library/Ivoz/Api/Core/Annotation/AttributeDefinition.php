<?php

namespace Ivoz\Api\Core\Annotation;

/**
 * Class AttributeOverwrite
 * @package Ivoz\Api\Core\Annotation
 * @Annotation
 * @Target("PROPERTY")
 */
final class AttributeDefinition
{
    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $type;


    /**
     * Internal type of arrays
     * @var string | null
     */
    public $collectionValueType;

    /**
     * @var string
     */
    public $class;

    /**
     * @var boolean
     */
    public $required = false;

    /**
     * @var boolean
     */
    public $writable = true;
}
