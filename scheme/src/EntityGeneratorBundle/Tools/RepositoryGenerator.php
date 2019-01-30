<?php

namespace EntityGeneratorBundle\Tools;

use Doctrine\ORM\Tools\EntityGenerator as ParentGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * Description of RepositoryGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class RepositoryGenerator extends ParentGenerator
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
        $metadata->name .= 'Repository';
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
            '<useStatement>' => '
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;',
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
        return
            'interface '
            . $this->getClassName($metadata)
            . ' extends  ObjectRepository, Selectable';
    }
}
