<?php

namespace Ivoz\Api\Swagger\Metadata\Resource\Factory;

use ApiPlatform\Core\Metadata\Resource\Factory\ResourceNameCollectionFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceNameCollection;
use Symfony\Component\Yaml\Yaml;

class YmlExtractorResourceNameCollectionFactory implements ResourceNameCollectionFactoryInterface
{
    private $sourceFileName;

    public function __construct($sourceFileName)
    {
        if (!file_exists($sourceFileName)) {
            throw new \Exception('File not found: ' . $sourceFileName);
        }

        $this->sourceFileName = $sourceFileName;
    }

    /**
     * @inheritdoc
     */
    public function create(): ResourceNameCollection
    {
        $resources = Yaml::parse(file_get_contents($this->sourceFileName));
        return new ResourceNameCollection(
            array_keys($resources)
        );
    }
}