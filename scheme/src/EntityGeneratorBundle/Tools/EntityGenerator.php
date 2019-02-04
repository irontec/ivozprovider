<?php

namespace EntityGeneratorBundle\Tools;

use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Tools\EntityGenerator as ParentGenerator;

/**
 * Description of EntityGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class EntityGenerator extends ParentGenerator
{
    protected $skipEmbeddedMethods = true;
    protected $codeCoverageIgnoreBlock = false;

    protected static $bodyTemplate =
    'use <className>Trait;

/**
 * @codeCoverageIgnore
 * @return array
 */
public function getChangeSet()
{
    return parent::getChangeSet();
}

/**
 * Get id
 * @codeCoverageIgnore
 * @return <idType>
 */
public function getId()
{
    return $this->id;
}';

    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityDocBlock(ClassMetadataInfo $metadata)
    {
        $lines = array();
        $lines[] = '/**';
        $lines[] = ' * ' . $this->getClassName($metadata);
        $lines[] = ' */';

        return implode("\n", $lines);
    }

    /**
     * {@inheritDoc}
     */
    protected function generateEntityBody(ClassMetadataInfo $metadata)
    {
        $className = $this->getClassName($metadata);
        $idType = $this->getIdType($metadata);
        $body = str_replace(
            ['<className>', '<idType>'],
            [$className, $idType],
            self::$bodyTemplate
        );

        return $this->prefixCodeWithSpaces($body);
    }

    protected function getIdType(ClassMetadataInfo $metadata)
    {
        $id = $metadata->getFieldMapping('id');
        return $id['type'];
    }


    /**
     * {@inheritDoc}
     */
    public function generateEntityClass(ClassMetadataInfo $metadata)
    {
        $placeHolders = array(
            '<namespace>',
            '<useStatement>',
            '<entityAnnotation>',
            '<entityClassName>',
            '<entityBody>'
        );

        $this->setFieldVisibility(self::FIELD_VISIBLE_PROTECTED);

        $replacements = array(
            $this->generateEntityNamespace($metadata),
            '',
            $this->generateEntityDocBlock($metadata),
            $this->generateEntityClassName($metadata),
            $this->generateEntityBody($metadata)
        );

        return str_replace(
            $placeHolders,
            $replacements,
            static::$classTemplate
        );
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
}
