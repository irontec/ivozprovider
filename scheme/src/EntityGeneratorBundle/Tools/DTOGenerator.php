<?php

namespace EntityGeneratorBundle\Tools;

use EntityGeneratorBundle\Tools\AbstractEntityGenerator as ParentGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\Common\Util\Inflector;

/**
 * Description of DTOGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class DTOGenerator extends ParentGenerator
{
    protected $codeCoverageIgnoreBlock = false;

    /**
     * @var string
     */
    protected static $constructorMethodTemplate =
'/**
 * @return array
 */
public function __toArray()
{
    return [<toArray>];
}

/**
 * {@inheritDoc}
 */
public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
{
<transformForeignKeys>
}

/**
 * {@inheritDoc}
 */
public function transformCollections(CollectionTransformerInterface $transformer)
{
<transformCollections>
}
';
    /**
     * @var string
     */
    protected static $setMethodTemplate =
'/**
 * @param <variableType> $<variableName>
 *
 * @return <entity>
 */
public function <methodName>(<methodTypeHint>$<variableName><variableDefault>)
{
<spaces>$this-><fieldName> = $<variableName>;

<spaces>return $this;
}';

    /**
     * @var string
     */
    protected static $getMethodTemplate =
'/**
 * @return <variableType>
 */
public function <methodName>()
{
<spaces>return $this-><fieldName>;
}';

    protected function transformMetadata(ClassMetadataInfo $metadata)
    {
        $metadata->name .= 'DTO';
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
        $placeHolders = array(
            '<namespace>',
            '<useStatement>',
            '<entityAnnotation>',
            '<entityClassName>',
            '<entityBody>'
        );

        $replacements = array(
            $this->generateEntityNamespace($metadata),
            $this->generateEntityRealUse($metadata),
            $this->generateEntityDocBlock($metadata),
            $this->generateEntityClassName($metadata),
            $this->generateEntityBody($metadata)
        );

        $code = str_replace($placeHolders, $replacements, static::$classTemplate) . "\n";

        return str_replace('<spaces>', $this->spaces, $code);
    }

    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityDocBlock(ClassMetadataInfo $metadata)
    {
        $lines = array();
        $lines[] = '/**';
        $lines[] = ' * @codeCoverageIgnore';
        $lines[] = ' */';

        return implode("\n", $lines);
    }

    /**
     * {@inheritDoc}
     */
    protected function generateFieldMappingPropertyDocBlock(array $fieldMapping, ClassMetadataInfo $metadata)
    {
        $field = (object) $fieldMapping;
        if (!array_key_exists('options', $fieldMapping)) {
            $fieldMapping['options'] = null;
        }

        $lines = array();
        $lines[] = $this->spaces . '/**';

        $fieldName = $field->fieldName;
        if (false !== strpos($fieldName, '.')) {
            $segments = explode('.', $fieldName);
            $fieldName = $this->getEmbeddedVarName($segments);
        }

        if (isset($field->columnName)) {

            $lines[] = $this->spaces
                . ' * @var '
                . $this->getType($fieldMapping['type']);

        } else {

            $oneToMany = $fieldMapping['type'] === ClassMetadataInfo::ONE_TO_MANY;
            $type = $oneToMany ? 'array|null' : 'mixed';
            $lines[] = $this->spaces . ' * @var ' . $type;
        }

        $lines[] = $this->spaces . ' */';

        return implode("\n", $lines);
    }

    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityClassName(ClassMetadataInfo $metadata)
    {
        $class = 'class '
            . $this->getClassName($metadata)
            . ($this->extendsClass() ? ' extends ' . $this->getClassToExtendName() : null);

        $class .= ' implements DataTransferObjectInterface';

        return $class;
    }

    protected function generateEntityRealUse(ClassMetadata $metadata)
    {
        $response = [
            'use Ivoz\\Core\\Application\\DataTransferObjectInterface;',
            'use Ivoz\\Core\\Application\\ForeignKeyTransformerInterface;',
            'use Ivoz\\Core\\Application\\CollectionTransformerInterface;'
        ];

        return "\n". implode("\n", $response) ."\n";
    }


    /**
     * {@inheritDoc}
     */
    protected function generateEntityConstructor(ClassMetadataInfo $metadata)
    {
        $response = parent::generateEntityConstructor($metadata);
        $transformForeignKeys = '';
        $transformCollections = '';

        $spaces = str_repeat($this->spaces, 2);
        $fkTransformers = $this->getFkTransformers($metadata);
        if (!empty($fkTransformers)) {
            $transformForeignKeys = $spaces . implode("\n" . $spaces, $fkTransformers);
        }

        $collectionTransformers = $this->getCollectionTransformers($metadata);
        if (!empty($collectionTransformers)) {
            $transformCollections = $spaces . implode("\n" . $spaces, $collectionTransformers);
        }

        $response = str_replace($this->spaces . '<transformForeignKeys>', $transformForeignKeys, $response);
        return str_replace($this->spaces . '<transformCollections>', $transformCollections, $response);
    }


    protected function getConstructorFields(ClassMetadataInfo $metadata)
    {
        $constructorArguments = [];
        $voContructor = [];
        $requiredSetters = [];
        $requiredGetters = [];
        $setters = [];
        $getters = [];
        $toArray = [];
        $updateFrom = [];
        $fromArray = [];

        $mappings = array_merge($metadata->fieldMappings, $metadata->associationMappings);

        foreach ($mappings as $fieldMapping) {
            $field = (object) $fieldMapping;
            $fieldName = $field->fieldName;
            $attribute = Inflector::camelize($fieldName);

            if (!array_key_exists('options', $fieldMapping)) {
                $fieldMapping['options'] = null;
            }
            $options  = (object) $fieldMapping['options'];

            //$fromArray[] = $this->getFromArrayMethod($attribute, $fieldName, $field);
            if (isset($field->targetEntity)) {

                $isOneToMany = ($field->type == ClassMetadataInfo::ONE_TO_MANY);
                if ($isOneToMany) {

                    $updateFrom[] =
                        'replace'
                        . Inflector::classify($fieldName)
                        . '($dto->get' . Inflector::classify($fieldName)
                        . '())';
                    $setters[$attribute] = 'replace'
                        . Inflector::classify($fieldName)
                        . '($dto->get'
                        . Inflector::classify($fieldName)
                        . '())';

                } else {

                    $updateFrom[] = 'set' . Inflector::classify($fieldName)
                        . '($dto->get' . Inflector::classify($fieldName) . '())';
                    $setters[$attribute] = 'set' . Inflector::classify($fieldName)
                        . '($dto->get' . Inflector::classify($fieldName) . '())';
                }

                list($associationToArray, $associationGetterAs) = $this
                    ->getConstructorAssociationFields($attribute, $fieldName, $isOneToMany);

                if (!is_null($associationToArray)) {
                    $toArray[] = $associationToArray;
                }

                $getters[$attribute] = $associationGetterAs;

                continue;
            }

            if (strpos($fieldName, '.')) {

                $segments = explode('.', $fieldName);
                $options = $fieldMapping['options'];
                $comment = array_key_exists('comment', $options)
                    ? $options['comment']
                    : '';

                $isMl = stripos($comment, '[ml]') !== false;
                $isFso = stripos($comment, '[fso') !== false;
                $ignorableFld = $segments[0] === $segments[1];

                $addVoContructor = ($isMl && $ignorableFld) || $isFso;

                if ($addVoContructor) {

                    $varName = $segments[0];
                    if (!array_key_exists($varName, $voContructor)) {
                        $voContructor[$varName] = [];
                    }
                    $voContructor[$varName][] = $this->getVoConstructor($varName, $metadata->fieldMappings);
                }

                $toArray[] =$this->embeddedToArrayGetter($segments);
                $setterMethod = 'set' . Inflector::classify($segments[0]);
                if ($segments[0] !== $segments[1]) {
                    $setterMethod .= Inflector::classify($segments[1]);
                }

                $getters[$segments[1]] =
                    $setterMethod
                    . '($this->get'
                    . Inflector::classify($segments[0])
                    . '()->get'
                    . Inflector::classify($segments[1])
                    . '()'
                    . ')';

                if ((isset($field->id) && $field->id) || isset($options->defaultValue)) {
                    continue;
                }

                $updateFrom[$segments[0]] =
                    'set'
                    . Inflector::classify($segments[0])
                    . '($' . $segments[0] . ')';

            } else {

                $toArray[]  = '\''. $attribute .'\' => $this->get' . Inflector::classify($fieldName) . '()';
                $getters[$attribute] = 'set' . Inflector::classify($fieldName)
                    . '($this->get' . Inflector::classify($fieldName) . '())';

                if ((isset($field->id) && $field->id) || isset($options->defaultValue)) {
                    continue;
                }

                $updateFrom[] = 'set' . Inflector::classify($fieldName)
                    . '($dto->get' . Inflector::classify($fieldName) . '())';

                if (isset($field->nullable) && $field->nullable && !$metadata->isEmbeddedClass) {
                    $setters[$attribute] = 'set' . Inflector::classify($fieldName)
                        . '($dto->get' . Inflector::classify($fieldName) . '())';
                    continue;
                }
            }

            if (array_key_exists('originalClass', $fieldMapping)) {
                $class = substr($fieldMapping['originalClass'], strrpos($fieldMapping['originalClass'], '\\') + 1);

                $declaredField = $fieldMapping['declaredField'];
                $attribute = $class . ' $' . $declaredField;

                $setter = 'set' . Inflector::classify($declaredField) . '($'. $declaredField .');';
                if (end($requiredSetters) !== $setter) {
                    $requiredSetters[$attribute] = $setter;
                }
            } else {

                $setter = 'set' . Inflector::classify($fieldName) . '($'. $attribute .');';
                $getter = 'get' . Inflector::classify($fieldName) . '()';
                $requiredSetters[$attribute] = $setter;
                $requiredGetters[$attribute] = $getter;

                if ($field->type[0] === '\\') {
                    $class = substr($field->type, strrpos($field->type, '\\') + 1);
                    $attribute = $class. ' $' . $attribute;
                } else {
                    $attribute = '$' . $attribute;
                }
            }

            if (end($constructorArguments) === $attribute) {
                continue;
            }

            $constructorArguments[] = $attribute;
        }

        return array(
            $constructorArguments,
            $voContructor,
            $requiredSetters,
            $requiredGetters,
            $setters,
            $getters,
            $toArray,
            $updateFrom,
            $fromArray
        );
    }


    /**
     * @param $segments
     * @param $toArray
     * @return array
     */
    protected function embeddedToArrayGetter($segments)
    {
        return
            '\''
            . $segments[0]
            . Inflector::classify($segments[1])
            . '\' => $this->get'
            . Inflector::classify($segments[0])
            . Inflector::classify($segments[1])
            . '()';
    }

    /**
     * {@inheritDoc}
     */
    protected function getFromArrayMethod($attribute, $fieldName, \stdClass $field)
    {
        $isAssociation = isset($field->targetEntity);

        if ($isAssociation && ($field->type === ClassMetadataInfo::ONE_TO_MANY)) {
            return '->set' . ucfirst($attribute) .'('
                . 'isset($data[\'' . $fieldName . '\'])'
                . ' ? '
                . '$data[\'' . $fieldName . '\']'
                . ' : null)';
        }

        if ($isAssociation) {
            $attribute .= 'Id';
            $fieldName .= 'Id';
        }

        return '->set' . ucfirst($attribute) .'('
            . 'isset($data[\'' . $fieldName . '\'])'
            . ' ? '
            . '$data[\'' . $fieldName . '\']'
            . ' : null)';
    }

    /**
     * {@inheritDoc}
     */
    protected function getConstructorAssociationFields($attribute, $fieldName, $isOneToMany)
    {
        $response = [];
        $response[] =
            '\'' . $attribute .'Id\' => '
            . '$this->get' . Inflector::classify($fieldName) . 'Id()';

        $response[] =
            'set' . Inflector::classify($fieldName) . 'Id('
            . '$this->get' . Inflector::classify($fieldName) . '()'
            . ' ? '
            . '$this->get' . Inflector::classify($fieldName) . '()->getId()'
            . ' : null'
            . ')';

        return $response;
    }


    protected function getFkTransformers(ClassMetadataInfo $metadata)
    {
        $fkTransformers = [];
        $mappings = $metadata->associationMappings;

        foreach ($mappings as $fieldMapping) {
            $field = (object) $fieldMapping;
            $fieldName = $field->fieldName;
            $attribute = Inflector::camelize($fieldName);

            if (!array_key_exists('options', $fieldMapping)) {
                $fieldMapping['options'] = null;
            }

            if ($metadata->isEmbeddedClass || $this->embeddablesImmutable) {
                continue;
            }

            $isOneToMany = $fieldMapping['type'] === ClassMetadataInfo::ONE_TO_MANY;

            if (isset($field->targetEntity) && !$isOneToMany) {

                $targetEntity = str_replace('\\', '\\\\', $field->targetEntity);
                $fkTransformers[] =
                    '$this->' . $attribute
                    . ' = '
                    . '$transformer->transform(\'' . $targetEntity . '\''
                    . ', $this->get' . ucfirst($attribute) . 'Id());';

            } else if (isset($field->targetEntity) && $isOneToMany) {

                $targetEntity = str_replace('\\', '\\\\', $field->targetEntity);

                if ($fieldMapping['type'] === ClassMetadataInfo::ONE_TO_MANY) {

                    $twoSpaces = str_repeat($this->spaces, 2);
                    $fourSpaces = str_repeat($this->spaces, 4);
                    $fiveSpaces = str_repeat($this->spaces, 5);

                    $fkTransformers[] = 'if (!is_null($this->' . $attribute . ')) {';
                    $fkTransformers[] =
                        $this->spaces
                        . '$items = $this->get'. ucfirst($attribute) .'();';
                    $fkTransformers[] =
                        $this->spaces
                        . '$this->' . $attribute . ' = [];';
                    $fkTransformers[] =
                        $this->spaces
                        . 'foreach ($items as $item) {';
                    $fkTransformers[] =
                        $twoSpaces
                        . '$this->' . $attribute . '[]'
                        . ' = '
                        . '$transformer->transform('
                        . "\n" . $fiveSpaces
                        . '\'' . $targetEntity . '\','
                        . "\n" . $fiveSpaces
                        . '$item' . '->getId() ?? $item'
                        . "\n" . $fourSpaces
                        . ');';
                    $fkTransformers[] = $this->spaces . "}";
                    $fkTransformers[] = "}\n";
                    continue;
                }

                $fkTransformers[] =
                    '$this->' . $attribute
                    . ' = '
                    . '$transformer->transform(\''. $targetEntity .'\''
                    . ', $this->get'. ucfirst($attribute) .'Id());';
            }
        }

        return $fkTransformers;
    }

    protected function getCollectionTransformers(ClassMetadataInfo $metadata)
    {
        $collectionTransformers = [];
        $mappings = $metadata->associationMappings;

        foreach ($mappings as $fieldMapping) {
            $field = (object) $fieldMapping;
            $fieldName = $field->fieldName;
            $attribute = Inflector::camelize($fieldName);

            if (!array_key_exists('options', $fieldMapping)) {
                $fieldMapping['options'] = null;
            }

            if ($metadata->isEmbeddedClass || $this->embeddablesImmutable) {
                continue;
            }

            if (isset($field->targetEntity) && $fieldMapping['type'] === ClassMetadataInfo::ONE_TO_MANY) {

                $targetEntity = str_replace('\\', '\\\\', $field->targetEntity);

                $twoSpaces = str_repeat($this->spaces, 2);
                $threeSpaces = str_repeat($this->spaces, 3);

                $collectionTransformers[] =
                    '$this->' . $attribute
                    . ' = '
                    . '$transformer->transform('
                    . "\n" . $threeSpaces
                    . '\'' . $targetEntity . '\','
                    . "\n" . $threeSpaces
                    . '$this->' . $attribute . "\n"
                    . $twoSpaces
                    . ');';

            }
        }

        return $collectionTransformers;
    }

    /**
     * {@inheritDoc}
     */
    protected function generateEntityFieldMappingProperties(ClassMetadataInfo $metadata)
    {
        $lines = array();
        $mapping = array_merge($metadata->fieldMappings, $metadata->associationMappings);

        foreach ($mapping as $fieldMapping) {

            $field = (object) $fieldMapping;
            $fieldName = $field->fieldName;

            if (isset($field->targetEntity) && $field->type !== ClassMetadataInfo::ONE_TO_MANY) {
                $lines[] = $this->generateFieldMappingPropertyDocBlock($fieldMapping, $metadata);
                $lines[] = $this->spaces . $this->fieldVisibility . ' $' . $fieldName . 'Id'
                    . (isset($fieldMapping['options']['default']) ? ' = ' . var_export($fieldMapping['options']['default'], true) : null) . ";\n";
            }

            if (isset($field->targetEntity)) {
                continue;
            }

            if (false !== strpos($fieldName, '.')) {
                $segments = explode('.', $fieldName);
                $fieldName = $this->getEmbeddedVarName($segments);
            }

            $lines[] = $this->generateFieldMappingPropertyDocBlock($fieldMapping, $metadata);
            $lines[] = $this->spaces . $this->fieldVisibility . ' $' . $fieldName
                . (isset($fieldMapping['options']['default']) ? ' = ' . var_export($fieldMapping['options']['default'], true) : null) . ";\n";
        }

        return implode("\n", $lines);
    }

    /**
     * {@inheritDoc}
     */
    protected function generateEntityAssociationMappingProperties(ClassMetadataInfo $metadata)
    {
        $lines = array();

        foreach ($metadata->associationMappings as $fieldMapping) {
            if ($this->hasProperty($fieldMapping['fieldName'], $metadata)) {
                continue;
            }

            $field = (object) $fieldMapping;

            if ($field->type === ClassMetadataInfo::ONE_TO_MANY) {

                $lines[] = $this->generateFieldMappingPropertyDocBlock($fieldMapping, $metadata);
                $lines[] = $this->spaces . $this->fieldVisibility . ' $' . $fieldMapping['fieldName'] . ' = null;'. "\n";
                continue;
            }

            $lines[] = $this->generateFieldMappingPropertyDocBlock($fieldMapping, $metadata);
            $lines[] = $this->spaces . $this->fieldVisibility . ' $' . $fieldMapping['fieldName']
                . (isset($fieldMapping['options']['default']) ? ' = ' . var_export($fieldMapping['options']['default'], true) : null) . ";\n";

        }

        return implode("\n", $lines);
    }


    /**
     * {@inheritDoc}
     */
    protected function generateEntityStubMethods(ClassMetadataInfo $metadata)
    {
        $methods = array();
        $fieldMappings = array_merge($metadata->fieldMappings, $metadata->associationMappings);
        foreach ($fieldMappings as $fieldMapping) {

//            if (isset($fieldMapping['declaredField']) &&
//                isset($metadata->embeddedClasses[$fieldMapping['declaredField']])
//            ) {
//                continue;
//            }

            $field = (object) $fieldMapping;
            if (isset($field->targetEntity)) {

                if ($fieldMapping['type'] === ClassMetadataInfo::MANY_TO_ONE) {
                    if ($code = $this->generateEntityStubMethod($metadata, 'set', $fieldMapping['fieldName'] . 'Id', 'integer')) {
                        $methods[] = $code;
                    }

                    if ($code = $this->generateEntityStubMethod($metadata, 'get', $fieldMapping['fieldName'] . 'Id', 'integer')) {
                        $methods[] = $code;
                    }

                    if ($code = $this->generateEntityStubMethod($metadata, 'get', $fieldMapping['fieldName'], $fieldMapping['targetEntity'])) {
                        $methods[] = $code;
                    }
                } else {
                    if ($code = $this->generateEntityStubMethod($metadata, 'set', $fieldMapping['fieldName'], \Doctrine\DBAL\Types\Type::SIMPLE_ARRAY)) {
                        $methods[] = $code;
                    }
                    if ($code = $this->generateEntityStubMethod($metadata, 'get', $fieldMapping['fieldName'], \Doctrine\DBAL\Types\Type::SIMPLE_ARRAY)) {
                        $methods[] = $code;
                    }
                }

                continue;
            }

            $fieldName = $fieldMapping['fieldName'];
            if (false !== strpos($fieldName, '.')) {
                $segments = explode('.', $fieldName);
                $fieldName = $this->getEmbeddedVarName($segments);
            }

            if ($code = $this->generateEntityStubMethod($metadata, 'set', $fieldName, $fieldMapping['type'])) {
                $methods[] = $code;
            }

            if ($code = $this->generateEntityStubMethod($metadata, 'get', $fieldName, $fieldMapping['type'])) {
                $methods[] = $code;
            }
        }

        $response = $methods;

        if ($this->codeCoverageIgnoreBlock) {
            array_unshift($response, $this->spaces . "// @codeCoverageIgnoreStart");
            $response[] = $this->spaces . "// @codeCoverageIgnoreEnd";
        }

        return implode("\n\n", $response);
    }

    /**
     * {@inheritDoc}
     */
    protected function generateAssociationMappingPropertyDocBlock(array $associationMapping, ClassMetadataInfo $metadata)
    {
        if ($associationMapping['type'] & ClassMetadataInfo::TO_MANY) {
            $lines = array();
            $lines[] = $this->spaces . '/**';
            $lines[] = $this->spaces . ' * @var array';
            $lines[] = $this->spaces . ' */';

            return implode("\n", $lines);
        }

        return parent::generateAssociationMappingPropertyDocBlock($associationMapping, $metadata);
    }
}
