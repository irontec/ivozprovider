<?php

namespace Ivoz\Api\Doctrine\Orm\Filter;

use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;

trait FilterTrait
{
    /**
     * @var ResourceMetadataFactoryInterface
     */
    protected $resourceMetadataFactory;

    public function setProperties(array $properties = null)
    {
        $this->properties = $properties;
    }

    private function overrideProperties(array $attributes)
    {
        if (!array_key_exists('filterFields', $attributes)) {
            $this->setProperties(null);
            return;
        }

        if (!array_key_exists(static::SERVICE_NAME, $attributes['filterFields'])) {
            $this->setProperties(null);
            return;
        }

        $fields = $attributes['filterFields'][static::SERVICE_NAME];
        $properties = [];
        foreach ($fields as $fld => $strategy) {
            $properties[$fld] = $strategy;
        }

        $this->setProperties($properties);
    }

    private function filterDescription(array $description)
    {
        return array_filter(
            $description,
            function ($key) {
                return strpos($key, '[]') === false;
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
