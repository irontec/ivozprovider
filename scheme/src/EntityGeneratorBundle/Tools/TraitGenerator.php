<?php

namespace EntityGeneratorBundle\Tools;

use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * Description of EntityGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class TraitGenerator extends AbstractEntityGenerator
{
    protected $skipEmbeddedMethods = true;
    protected $codeCoverageIgnoreBlock = false;

    protected function transformMetadata(ClassMetadataInfo $metadata)
    {
        $metadata->name .= 'Trait';
        $metadata->rootEntityName = $metadata->name;
        $metadata->customRepositoryClassName = null;

        return parent::transformMetadata($metadata);
    }

    /**
     * {@inheritDoc}
     */
    protected function generateEntityClassName(ClassMetadataInfo $metadata)
    {
        $className = $this->getClassName($metadata);

        return 'trait ' . $className;
    }

    /**
     * @var string
     */
    protected static $constructorMethodTemplate =
        '
/**
 * Constructor
 */
public function __construct(<requiredFields>)<lineBreak>{
<spaces>parent::__construct(...func_get_args());
<requiredFieldsSetters><collections>
}

/**
 * @return <dtoClass>
 */
public static function createDTO()
{
    return new <dtoClass>();
}

/**
 * Factory method
 * @param DataTransferObjectInterface $dto
 * @return self
 */
public static function fromDTO(DataTransferObjectInterface $dto)
{
    /**
     * @var $dto <dtoClass>
     */
    $self = parent::fromDTO($dto);
<fromDTO>
    if ($dto->getId()) {
        $self->id = $dto->getId();
        $self->initChangelog();
    }

    return $self;
}

/**
 * @param DataTransferObjectInterface $dto
 * @return self
 */
public function updateFromDTO(DataTransferObjectInterface $dto)
{
    /**
     * @var $dto <dtoClass>
     */
    parent::updateFromDTO($dto);
<updateFromDTO>
    return $this;
}

/**
 * @return <dtoClass>
 */
public function toDTO()
{
    $dto = parent::toDTO();
    return $dto<toDTO>;
}

/**
 * @return array
 */
protected function __toArray()
{
    return parent::__toArray() + [<toArray>];
}

';

    /**
     * {@inheritDoc}
     */
    protected function generateEntityFieldMappingProperties(ClassMetadataInfo $metadata)
    {
        $lines = array();

        foreach ($metadata->fieldMappings as $fieldMapping) {

            if (isset($fieldMapping['declared'])) {
                continue;
            }

            if ($this->hasProperty($fieldMapping['fieldName'], $metadata) ||
                $metadata->isInheritedField($fieldMapping['fieldName']) ||
                (
                    isset($fieldMapping['declaredField']) &&
                    isset($metadata->embeddedClasses[$fieldMapping['declaredField']])
                )
            ) {
                continue;
            }

            $lines[] = $this->generateFieldMappingPropertyDocBlock($fieldMapping, $metadata);
            $lines[] = $this->spaces . $this->fieldVisibility . ' $' . $fieldMapping['fieldName']
                . (isset($fieldMapping['options']['default']) ? ' = ' . var_export($fieldMapping['options']['default'], true) : null) . ";\n";
        }

        return implode("\n", $lines);
    }


    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityAssociationMappingProperties(ClassMetadataInfo $metadata)
    {
        $lines = array();

        foreach ($metadata->associationMappings as $associationMapping) {
            if ($this->hasProperty($associationMapping['fieldName'], $metadata)) {
                continue;
            }

            if (isset($associationMapping['declared'])) {
                continue;
            }

            $lines[] = $this->generateAssociationMappingPropertyDocBlock($associationMapping, $metadata);
            $lines[] = $this->spaces . $this->fieldVisibility . ' $' . $associationMapping['fieldName']
                . ($associationMapping['type'] == 'manyToMany' ? ' = array()' : null) . ";\n";
        }

        return implode("\n", $lines);
    }


    /**
     * @param string            $property
     * @param ClassMetadataInfo $metadata
     *
     * @return bool
     */
    protected function hasProperty($property, ClassMetadataInfo $metadata)
    {
        if ($this->extendsClass() || (!$this->isNew && class_exists($metadata->name))) {
            // don't generate property if its already on the base class.
            $reflClass = new \ReflectionClass($this->getClassToExtend() ?: $metadata->name);
            if ($reflClass->hasProperty($property)) {
                return true;
            }
        }

        return (
            isset($this->staticReflection[$metadata->name]) &&
            in_array($property, $this->staticReflection[$metadata->name]['properties'])
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function hasMethod($method, ClassMetadataInfo $metadata)
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    protected function generateEntityStubMethods(ClassMetadataInfo $metadata)
    {
        $fieldMappings = $metadata->fieldMappings;
        $associationMapping = $metadata->associationMappings;
        $embeddedClasses = $metadata->embeddedClasses;

        $metadata->fieldMappings = [];
        $metadata->associationMappings = [];

        if ($this->skipEmbeddedMethods) {
            $metadata->embeddedClasses = [];
        }

        $parentMethodsStr = parent::generateEntityStubMethods($metadata);
        $parentMethods = explode("\n\n", $parentMethodsStr);

        $metadata->embeddedClasses = $embeddedClasses;
        $methods = array();

        $metadata->associationMappings = $associationMapping;
        $metadata->fieldMappings = $fieldMappings;

        foreach ($metadata->associationMappings as $associationMapping) {

            if (isset($associationMapping['declared'])) {
                continue;
            }

            if ($associationMapping['type'] & ClassMetadataInfo::TO_MANY) {
                if ($code = $this->generateEntityStubMethod($metadata, 'add', $associationMapping['fieldName'], $associationMapping['targetEntity'])) {
                    $methods[] = $code;
                }
                if ($code = $this->generateEntityStubMethod($metadata, 'remove', $associationMapping['fieldName'], $associationMapping['targetEntity'])) {
                    $methods[] = $code;
                }
                if ($code = $this->generateEntityStubMethod($metadata, 'replace', $associationMapping['fieldName'], 'IteratorAggregate')) {
                    $methods[] = $code;
                }
                if ($code = $this->generateEntityStubMethod($metadata, 'get', $associationMapping['fieldName'], 'Doctrine\Common\Collections\Collection')) {
                    $methods[] = $code;
                }
            }
        }

        $response = array_merge($methods, $parentMethods);

        if ($this->codeCoverageIgnoreBlock) {
            array_unshift($response, $this->spaces . "// @codeCoverageIgnoreStart");
            $response[] = $this->spaces . "// @codeCoverageIgnoreEnd";
        }

        return implode("\n\n", $response);
    }
}
