<?php

namespace Ivoz\Api\Swagger\Metadata\Resource\Factory;

use ApiPlatform\Core\Metadata\Resource\Factory\ResourceNameCollectionFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceNameCollection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;

class YmlExtractorResourceNameCollectionFactory implements ResourceNameCollectionFactoryInterface
{
    /**
     * @var string
     */
    private $sourceFilePath;

    /**
     * @var Finder
     */
    private $finder;

    public function __construct(
        string $sourceFilePath,
        Finder $finder
    ) {
        if (!file_exists($sourceFilePath)) {
            throw new \Exception('Directory not found: ' . $sourceFilePath);
        }

        $this->sourceFilePath = $sourceFilePath;
        $this->finder = $finder;
    }

    /**
     * @inheritdoc
     */
    public function create(): ResourceNameCollection
    {
        $resourceNames = [];
        $resourceFiles = $this
            ->finder
            ->files()
            ->in($this->sourceFilePath);

        foreach ($resourceFiles as $fileName) {
            $resources = Yaml::parse(file_get_contents($fileName));
            array_unshift($resourceNames, ...array_keys($resources));
        }

        return new ResourceNameCollection(
            $resourceNames
        );
    }
}
