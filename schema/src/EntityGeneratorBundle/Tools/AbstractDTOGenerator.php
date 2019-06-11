<?php

namespace EntityGeneratorBundle\Tools;

use Doctrine\ORM\Tools\EntityGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\Common\Util\Inflector;
use Doctrine\DBAL\Types\Type;

/**
 * Description of DTOGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class AbstractDTOGenerator extends EntityGenerator
{
    protected $typeAlias = array(
        'guid'              => 'string',
        Type::DATETIMETZ    => '\DateTime',
        Type::DATETIME      => '\DateTime',
        Type::DATE          => '\DateTime',
        Type::TIME          => '\DateTime',
        Type::OBJECT        => '\stdClass',
        Type::BIGINT        => 'integer',
        Type::SMALLINT      => 'integer',
        Type::TEXT          => 'string',
        Type::BLOB          => 'string',
        Type::DECIMAL       => 'float',
        Type::JSON_ARRAY    => 'array',
        Type::SIMPLE_ARRAY  => 'array',
    );

    protected $codeCoverageIgnoreBlock = false;

    /**
     * @var string
     */
    protected static $constructorMethodTemplate =
    '
use DtoNormalizer;

public function __construct($id = null)
{
    $this->setId($id);
}

/**
 * @inheritdoc
 */
public static function getPropertyMap(string $context = \'\', string $role = null)
{
    if ($context === self::CONTEXT_COLLECTION) {
        return [\'id\' => \'id\'];
    }

    return [
        <propertyMap>
    ];
}

/**
 * @return array
 */
public function toArray($hideSensitiveData = false)
{
    return [<toArray>];
}
';
    /**
     * @var string
     */
    protected static $setMethodTemplate =
    '/**
 * @param <variableType> $<variableName>
 *
 * @return static
 */
public function <methodName>(<methodTypeHint>$<variableName><variableDefault>)
{
<spaces>$this-><fieldName> = $<variableName>;

<spaces>return $this;
}';

    /**
     * @var string
     */
    protected static $setIdMethodTemplate =
    '/**
 * @param mixed | null $id
 *
 * @return static
 */
public function <methodName>Id($id)
{
    $value = !is_null($id)
        ? new \\<typeHint>($id)
        : null;

    return $this-><methodName>($value);
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

    /**
     * @var string
     */
    protected static $getIdMethodTemplate =
    '/**
 * @return mixed | null
 */
public function <methodName>Id()
{
    if ($dto = $this-><methodName>()) {
        return $dto->getId();
    }

    return null;
}';

    /**
     * @var string
     */
    protected static $lifecycleCallbackMethodTemplate = '';

    /**
     * {@inheritDoc}
     */
    public function writeEntityClass(ClassMetadataInfo $metadata, $outputDirectory)
    {
        return parent::writeEntityClass($this->transformMetadata($metadata), $outputDirectory);
    }

    protected function transformMetadata(ClassMetadataInfo $metadata)
    {
        $metadata->name .= 'DtoAbstract';
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

        $code = str_replace($placeHolders, $replacements, static::$classTemplate);

        return str_replace('<spaces>', $this->spaces, $code);
    }


    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityBody(ClassMetadataInfo $metadata)
    {
        return parent::generateEntityBody($metadata);
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

        if (isset($field->columnName) && $this->isDateType($fieldMapping['type'])) {
            $lines[] = $this->spaces
                . ' * @var '
                . $this->getType($fieldMapping['type'])
                . ' | string' ;
        } elseif (isset($field->columnName)) {
            $lines[] = $this->spaces
                . ' * @var '
                . $this->getType($fieldMapping['type']);
        } else {
            $oneToMany = $fieldMapping['type'] === ClassMetadataInfo::ONE_TO_MANY;
            $type = '\\' . $fieldMapping['targetEntity'] . 'Dto';
            if ($oneToMany) {
                $type .= '[]';
            }
            $type .= ' | null';
            $lines[] = $this->spaces . ' * @var ' . $type;
        }

        $lines[] = $this->spaces . ' */';

        return implode("\n", $lines);
    }

    protected function isDateType(string $type)
    {
        return in_array(
            $type,
            ['datetime', 'time', 'date', ]
        );
    }

    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityClassName(ClassMetadataInfo $metadata)
    {
        $class = 'abstract class '
            . $this->getClassName($metadata)
            . ($this->extendsClass() ? ' extends ' . $this->getClassToExtendName() : null);

        $class .= ' implements DataTransferObjectInterface';

        return $class;
    }

    protected function generateEntityRealUse(ClassMetadata $metadata)
    {
        $response = [
            'use Ivoz\\Core\\Application\\DataTransferObjectInterface;',
            'use Ivoz\\Core\\Application\\Model\\DtoNormalizer;'
        ];

        return "\n". implode("\n", $response) ."\n";
    }

    /**
     * {@inheritDoc}
     */
    protected function generateEntityConstructor(ClassMetadataInfo $metadata)
    {
        list(
            $getters,
            $toArray,
            $propertyMap
            ) = $this->getConstructorFields($metadata);

        if (empty($collections) && empty($getters)) {
            return '';
        }

        $response = static::$constructorMethodTemplate;
        $spaces = str_repeat($this->spaces, 2);

        $toArrayGetters = '';
        if (!empty($toArray)) {
            $toArrayGetters = "\n" . $spaces . implode(",\n" . $spaces, $toArray) . "\n" . $this->spaces;
            $propertyMap = $this->propertyMapStringify($propertyMap, $spaces);
        }

        $namespaceSegments = explode('\\', $metadata->namespace);
        $namespace = end($namespaceSegments) . 'Dto';
        $response = str_replace('<dtoClass>', $namespace, $response);

        $response = str_replace('<toArray>', $toArrayGetters, $response);
        $response = str_replace('<propertyMap>', $propertyMap, $response);

        $response = $this->prefixCodeWithSpaces($response);
        return $response;
    }

    private function propertyMapStringify($propertyMap, $spaces = '')
    {
        $response = [];

        foreach ($propertyMap as $key => $value) {
            $value = is_array(($value))
                ? $this->subPropertyMapStringify($value)
                : "'" . $value . "'";

            $response[] =
                "'"
                . $key
                . "' => "
                . $value;
        }

        return
            implode(",\n" . $spaces, $response);
    }

    private function subPropertyMapStringify($propertyMap)
    {
        return
            '[\''
            . implode("','", $propertyMap)
            . '\']';
    }

    protected function getConstructorFields(ClassMetadataInfo $metadata)
    {
        $getters = [];
        $toArray = [];
        $propertyMap = [];

        $mappings = array_merge(
            $metadata->fieldMappings,
            $metadata->associationMappings
        );

        foreach ($mappings as $fieldMapping) {
            $field = (object) $fieldMapping;
            $fieldName = $field->fieldName;
            $attribute = Inflector::camelize($fieldName);

            if (!array_key_exists('options', $fieldMapping)) {
                $fieldMapping['options'] = null;
            }

            if (isset($field->targetEntity)) {
                $isOneToMany = ($field->type == ClassMetadataInfo::ONE_TO_MANY);
                list($associationToArray, $associationGetterAs) = $this
                    ->getConstructorAssociationFields($attribute, $fieldName, $isOneToMany);

                if (!is_null($associationToArray)) {
                    $toArray[$fieldName] = $associationToArray;
                }

                if (!$isOneToMany && !is_null($associationToArray)) {
                    $propertyMap[$fieldName . 'Id'] = $fieldName;
                }

                $getters[$attribute] = $associationGetterAs;
            } elseif (strpos($fieldName, '.')) {
                $segments = explode('.', $fieldName);

                if (!array_key_exists($segments[0], $toArray)) {
                    $toArray[$segments[0]] = $this->embeddedToArray($segments[0], $metadata->fieldMappings);
                }

                if (!isset($propertyMap[$segments[0]])) {
                    $propertyMap[$segments[0]] = [];
                }
                $propertyMap[$segments[0]][] = $segments[1];

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
            } else {
                $propertyMap[$fieldName] =  $fieldName;
                $toArray[$fieldName]  = '\''. $attribute .'\' => $this->get' . Inflector::classify($fieldName) . '()';
                $getters[$attribute] = 'set' . Inflector::classify($fieldName)
                    . '($this->get' . Inflector::classify($fieldName) . '())';
            }
        }

        return array(
            $getters,
            $toArray,
            $propertyMap
        );
    }

    protected function getVoConstructor($voName, array $fieldMappings)
    {
        $arguments = [];
        $class = [];

        foreach ($fieldMappings as $fieldMapping) {
            if (false === strpos($fieldMapping['fieldName'], '.')) {
                continue;
            }
            $segments = explode('.', $fieldMapping['fieldName']);
            if ($segments[0] !== $voName) {
                continue;
            }

            $class = explode("\\", $fieldMapping['originalClass']);
            $method = end($class);
            if (strtolower($method) !== strtolower($segments[1])) {
                $method .= Inflector::classify($segments[1]);
            }

            $arguments[] =
                $this->spaces
                . '$dto->get'
                . $method
                . '()';
        }
        $response = '$' . $voName . ' = new ' . end($class) . "(%s);\n";

        if (!empty($arguments)) {
            $value =
                "\n"
                . $this->spaces
                . implode(",\n" . str_repeat($this->spaces, 1), $arguments)
                . "\n"
                . $this->spaces;

            $response =
                $this->spaces
                . sprintf($response, $value);
        } else {
            $response = sprintf($response, '');
        }

        return $response;
    }


    /**
     * @param $segments
     * @param $toArray
     * @return array
     */
    protected function embeddedToArray($voName, array $fieldMappings)
    {
        $arguments = [];

        foreach ($fieldMappings as $fieldMapping) {
            if (false === strpos($fieldMapping['fieldName'], '.')) {
                continue;
            }
            $segments = explode('.', $fieldMapping['fieldName']);
            if ($segments[0] !== $voName) {
                continue;
            }

            $class = explode("\\", $fieldMapping['originalClass']);
            $method = end($class);
            if (strtolower($method) !== strtolower($segments[1])) {
                $method .= Inflector::classify($segments[1]);
            }

            $arguments[] =
                $this->spaces
                . "'"
                . $segments[1]
                . "' => "
                . '$this->get'
                . $method
                . '()';
        }
        $response =
            "'"
            . $voName
            . "' => [%s]";

        if (!empty($arguments)) {
            $spaces = str_repeat($this->spaces, 2);
            $value =
                "\n"
                . $spaces
                . implode(",\n" . $spaces, $arguments)
                . "\n"
                . $spaces;

            $response = sprintf($response, $value);
        } else {
            $response = sprintf($response, '');
        }

        return $response;
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
        $idGetter = $isOneToMany
            ? ''
            : 'Id';

        $response = [];
        $response[] =
            '\'' . $attribute . '\' => '
            . '$this->get' . Inflector::classify($fieldName) . '()';

        $response[] =
            'set' . Inflector::classify($fieldName) . $idGetter . '('
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
                    . '$transformer->transform($this->get' . ucfirst($attribute) . '());';
            } elseif (isset($field->targetEntity) && $isOneToMany) {
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
                        . '$transformer->transform($item);';

                    $fkTransformers[] = $this->spaces . "}";
                    $fkTransformers[] = "}";
                    continue;
                }

                $fkTransformers[] =
                    '$this->' . $attribute
                    . ' = '
                    . '$transformer->transform($this->get'. ucfirst($attribute) .'());';
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

            if (isset($field->targetEntity)) {
                continue;
            }

            if (false !== strpos($fieldName, '.')) {
                $segments = explode('.', $fieldName);
                $fieldName = $this->getEmbeddedVarName($segments);
            }

            $defaultValue = '';
            $isBoolean = $fieldMapping['type'] === 'boolean' ?? false;
            $hasDefaultValue = isset($fieldMapping['options']['default']);
            if ($hasDefaultValue && $isBoolean) {
                $defaultValue = ' = ' . var_export(
                    boolval($fieldMapping['options']['default']),
                    true
                );
            } elseif ($hasDefaultValue) {
                $defaultValue = ' = ' . var_export($fieldMapping['options']['default'], true);
            }

            $lines[] = $this->generateFieldMappingPropertyDocBlock($fieldMapping, $metadata);
            $lines[] =
                $this->spaces
                . $this->fieldVisibility
                . ' $' . $fieldName
                . $defaultValue
                . ";\n";
        }

        return implode("\n", $lines);
    }

    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityEmbeddedProperties(ClassMetadataInfo $metadata)
    {
        return '';
    }

    /**
     * @param array $segments
     * @return string
     */
    protected function getEmbeddedVarName(array $segments)
    {
        return $segments[0] !== $segments[1]
            ? $segments[0] . ucfirst($segments[1])
            : $segments[0];
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
            $field = (object) $fieldMapping;
            if (isset($field->targetEntity)) {
                if (in_array($fieldMapping['type'], [ClassMetadataInfo::MANY_TO_ONE, ClassMetadataInfo::ONE_TO_ONE])) {
                    if ($code = $this->generateEntityStubMethod($metadata, 'set', $fieldMapping['fieldName'], $fieldMapping['targetEntity'])) {
                        $methods[] = $code;
                    }

                    if ($code = $this->generateEntityStubMethod($metadata, 'get', $fieldMapping['fieldName'], $fieldMapping['targetEntity'])) {
                        $methods[] = $code;
                    }

                    $methods[] = $this->generateIdStubMethod('set', $fieldMapping['fieldName'], $fieldMapping['targetEntity'] . 'Dto');
                    $methods[] = $this->generateIdStubMethod('get', $fieldMapping['fieldName'], $fieldMapping['targetEntity'] . 'Dto');
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

        $stubMethods = implode("\n\n", $response);

        if ($this->codeCoverageIgnoreBlock) {
            $stubMethods = $this->spaces . "// @codeCoverageIgnoreStart\n" . $stubMethods;
            $stubMethods .= $this->spaces . "// @codeCoverageIgnoreEnd";
        }

        return $stubMethods;
    }

    /**
     * {@inheritDoc}
     */
    protected function generateEntityStubMethod(ClassMetadataInfo $metadata, $type, $fieldName, $typeHint = null, $defaultValue = null)
    {
        $isNullable = true;

        if (is_null($defaultValue) && $isNullable) {
            $defaultValue = 'null';
        }

        if (strpos($typeHint, '\\')) {
            $typeHint .= 'Dto';
        }

        if ($typeHint[0] === '\\') {
            // typehints are always prefixed in parent::generateEntityStubMethod
            $typeHint = substr($typeHint, 1) . 'Dto';
        }

        $isCollection = strpos($typeHint, 'Doctrine\\Common\\Collections\\Collection') !== false;
        if ($isCollection) {
            $typeHint = 'array';
        }

        return $this->_generateEntityStubMethod($metadata, $type, $fieldName, $typeHint, $defaultValue);
    }

    /**
     * {@inheritDoc}
     */
    protected function _generateEntityStubMethod(ClassMetadataInfo $metadata, $type, $fieldName, $typeHint = null, $defaultValue = null)
    {
        $currentField = null;
        $isNullable = false;
        $visibility = $metadata->isEmbeddedClass
            ? 'protected'
            : 'public';

        if (array_key_exists($fieldName, $metadata->fieldMappings)) {
            $currentField = (object) $metadata->fieldMappings[$fieldName];
            $isNullable = isset($currentField->nullable) && $currentField->nullable;
        }

        if (is_null($defaultValue) && $isNullable) {
            $defaultValue = 'null';
        }

        if ($typeHint[0] === '\\') {
            // typehints are always prefixed in parent::generateEntityStubMethod
            $typeHint = substr($typeHint, 1);
        }

        $isCollection = strpos($typeHint, 'Doctrine\\Common\\Collections\\Collection') !== false;
        if ($isCollection) {
            $typeHint = 'array';
        }

        $parentResponse = parent::generateEntityStubMethod($metadata, $type, $fieldName, $typeHint, $defaultValue);
        $parentResponse = str_replace('(\\' . $metadata->namespace . '\\', '(', $parentResponse);

        $replacements = array(
            $this->spaces . '<assertions>' =>'',
            '<visibility>' => $visibility
        );

        if ($type == 'replace') {
            $replacements['<addRel>'] = Inflector::singularize(
                'add' . Inflector::classify($fieldName)
            );
            $replacements['<removeRel>'] = Inflector::singularize(
                'remove' . Inflector::classify($fieldName)
            );
            $replacements['<relEntity>'] = $metadata->associationMappings[$fieldName]['targetEntity'];
        }

        if (array_key_exists($fieldName, $metadata->associationMappings)) {
            $field = (object) $metadata->associationMappings[$fieldName];
            $isOneToMany = ($field->type == ClassMetadataInfo::ONE_TO_MANY);

            if ($field->inversedBy && $type === 'set') {
                $replacements['<visibility>'] = 'public';
            }

            if ($isOneToMany && !in_array($type, ['set', 'get'])) {
                $replacements['<mappedBy>'] = ucFirst($field->mappedBy);
            }
        }

        $response = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $parentResponse
        );


        //Collection + Criteria
        $criteriaArgument = '';
        $criteriaGetter = '';
        $forcedArray = '';

        if ($isCollection && $type === 'get') {
            $criteriaArgument = 'Criteria $criteria = null';
            $criteriaGetter = "\n";
            $criteriaGetter .= "if (!is_null(\$criteria)) {\n";
            $criteriaGetter .= $this->spaces;
            $criteriaGetter .= 'return $this->'. $fieldName ."->matching(\$criteria)->toArray();\n";
            $criteriaGetter .= "}\n";

            $forcedArray = '->toArray()';

            $criteriaGetter = $this->prefixCodeWithSpaces($criteriaGetter, 2);
        }

        $response = str_replace(
            ['<criteriaArgument>', '<criteriaGetter>', '<forcedArray>'],
            [$criteriaArgument, $criteriaGetter, $forcedArray],
            $response
        );

        return $response;
    }


    /**
     * {@inheritDoc}
     */
    protected function generateIdStubMethod(string $type, string $attributeName, string $typeHint = null)
    {
        $replacements = [
            '<methodName>' => $type . ucfirst($attributeName),
            '<typeHint>' => $typeHint
        ];

        $template = $type == 'set'
            ? self::$setIdMethodTemplate
            : self::$getIdMethodTemplate;

        $response = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $template
        );

        return $this->prefixCodeWithSpaces(
            $response
        );
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
