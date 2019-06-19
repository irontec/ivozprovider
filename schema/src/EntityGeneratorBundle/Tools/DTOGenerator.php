<?php

namespace EntityGeneratorBundle\Tools;

use Doctrine\ORM\Tools\EntityGenerator as ParentGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * Description of DTOGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class DTOGenerator extends ParentGenerator
{
    protected $codeCoverageIgnoreBlock = false;

    /**
     * {@inheritDoc}
     */
    public function writeEntityClass(ClassMetadataInfo $metadata, $outputDirectory)
    {
        return parent::writeEntityClass($this->transformMetadata($metadata), $outputDirectory);
    }

    protected function transformMetadata(ClassMetadataInfo $metadata)
    {
        $metadata->name .= 'Dto';
        $metadata->rootEntityName = $metadata->name;
        $metadata->customRepositoryClassName = null;

        if (class_exists($metadata->name)) {
            $metadata->reflClass = new \ReflectionClass($metadata->name);
        }

        return $metadata;
    }

    /**
     * {@inheritDoc}
     */
    public function generateEntityClass(ClassMetadataInfo $metadata)
    {
        $replacements = array(
            '<namespace>' => $this->generateEntityNamespace($metadata),
            '<useStatement>' => '',
            '<entityAnnotation>' => '',
            '<entityClassName>' => $this->generateEntityClassName($metadata),
            '<entityBody>' => ''
        );

        $code = str_replace(
            array_keys($replacements),
            array_values($replacements),
            static::$classTemplate
        );

        return str_replace('<spaces>', $this->spaces, $code);
    }

    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityClassName(ClassMetadataInfo $metadata)
    {
        $class =
            'class '
            . $this->getClassName($metadata)
            . ' extends '
            . $this->getClassName($metadata)
            . 'Abstract';

        return $class;
    }
}
