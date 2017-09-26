<?php

namespace EntityGeneratorBundle\Tools;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * Description of EntityGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class EntityGenerator extends AbstractEntityGenerator
{
    protected $skipEmbeddedMethods = true;
    protected $codeCoverageIgnoreBlock = false;

    /**
     * @var string
     */
    protected static $template = '';

    /**
     * {@inheritDoc}
     */
    protected function generateEntityBody(ClassMetadataInfo $metadata)
    {
        $namespace = $metadata->name;
        $namespaceSegments = explode('\\', $namespace);
        $className = end($namespaceSegments) . 'Trait';

        return $this->prefixCodeWithSpaces('use ' . $className . ';');
    }

    /**
     * {@inheritDoc}
     */
    protected function generateEntityFieldMappingProperties(ClassMetadataInfo $metadata)
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    protected function generateEntityClassName(ClassMetadataInfo $metadata)
    {
        $className = $this->getClassName($metadata);
        $class = 'class '
            . $className
            . ' extends '
            . $className . 'Abstract'
            . ' implements ' . $className . 'Interface';

        return $class;
    }

    protected function generateEntityRealUse(ClassMetadata $metadata)
    {
        return '';
    }
}
