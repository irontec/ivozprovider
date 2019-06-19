<?php

namespace EntityGeneratorBundle\Tools;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Tools\EntityGenerator;
use Doctrine\Common\Util\Inflector;
use Doctrine\DBAL\Types\Type;

/**
 * Description of EntityGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class TraitGenerator extends EntityGenerator
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

    protected $skipEmbeddedMethods = true;
    protected $codeCoverageIgnoreBlock = false;

    /**
     * @var string
     */
    protected static $constructorMethodTemplate =
        '
/**
 * Constructor
 */
protected function __construct(<requiredFields>)<lineBreak>{
<spaces>parent::__construct(...func_get_args());
<requiredFieldsSetters>
<collections>
}

abstract protected function sanitizeValues();

/**
 * Factory method
 * @internal use EntityTools instead
 * @param <dtoClass> $dto
 * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
 * @return static
 */
public static function fromDto(
    DataTransferObjectInterface $dto,
    \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
) {
    /** @var static $self */
    $self = parent::fromDto($dto, $fkTransformer);
<fromDTO>
    $self->sanitizeValues();
    if ($dto->getId()) {
        $self->id = $dto->getId();
        $self->initChangelog();
    }

    return $self;
}

/**
 * @internal use EntityTools instead
 * @param <dtoClass> $dto
 * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
 * @return static
 */
public function updateFromDto(
    DataTransferObjectInterface $dto,
    \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
) {
    parent::updateFromDto($dto, $fkTransformer);
<updateFromDTO>
    $this->sanitizeValues();

    return $this;
}

/**
 * @internal use EntityTools instead
 * @param int $depth
 * @return <dtoClass>
 */
public function toDto($depth = 0)
{
    $dto = parent::toDto($depth);
    return $dto<toDTO>;
}

/**
 * @return array
 */
protected function __toArray()
{
    return parent::__toArray() + [<toArray>];
}';

    /**
     * @var string
     */
    protected static $setMethodTemplate =
        '/**
 * <description>
 *
 * @param <variableType> $<variableName>
 *
 * @return static
 */
<visibility> function <methodName>(<methodTypeHint>$<variableName><variableDefault>)
{
<assertions>$this-><fieldName> = $<variableName>;

<spaces>return $this;
}';


    /**
     * @var string
     */
    protected static $getMethodTemplate =
    '/**
 * <description>
 *<criteriaArgumentDoc>
 * @return <variableType>
 */
public function <methodName>(<criteriaArgument>)
{<criteriaGetter>
<spaces>return $this-><fieldName><forcedArray>;
}';

    /**
     * @var string
     */
    protected static $addMethodTemplate =
    '/**
 * <description>
 *
 * @param <variableType> $<variableName>
 *
 * @return static
 */
<visibility> function <methodName>(<methodTypeHint>$<variableName>)
{
<spaces>$this-><fieldName>->add($<variableName>);

<spaces>return $this;
}';

    /**
     * @var string
     */
    protected static $replaceMethodTemplate =
    '/**
 * <description>
 *
 * @param ArrayCollection $<variableName> of <relEntity>
 * @return static
 */
<visibility> function <methodName>(ArrayCollection $<variableName>)
{
<spaces>$updatedEntities = [];
<spaces>$fallBackId = -1;
<spaces>foreach ($<variableName> as $entity) {
<spaces><spaces>$index = $entity->getId() ? $entity->getId() : $fallBackId--;
<spaces><spaces>$updatedEntities[$index] = $entity;
<spaces><spaces>$entity->set<mappedBy>($this);
<spaces>}
<spaces>$updatedEntityKeys = array_keys($updatedEntities);

<spaces>foreach ($this-><fieldName> as $key => $entity) {
<spaces><spaces>$identity = $entity->getId();
<spaces><spaces>if (in_array($identity, $updatedEntityKeys)) {
<spaces><spaces><spaces>$this-><fieldName>->set($key, $updatedEntities[$identity]);
<spaces><spaces>} else {
<spaces><spaces><spaces>$this-><fieldName>->remove($key);
<spaces><spaces>}
<spaces><spaces>unset($updatedEntities[$identity]);
<spaces>}

<spaces>foreach ($updatedEntities as $entity) {
<spaces><spaces>$this-><addRel>($entity);
<spaces>}

<spaces>return $this;
}';

    /**
     * {@inheritDoc}
     */
    public function writeEntityClass(ClassMetadataInfo $metadata, $outputDirectory)
    {
        return parent::writeEntityClass($this->transformMetadata($metadata), $outputDirectory);
    }

    protected function transformMetadata(ClassMetadataInfo $metadata)
    {
        $metadata->name .= 'Trait';
        $metadata->rootEntityName = $metadata->name;
        $metadata->customRepositoryClassName = null;

        foreach ($metadata->associationMappings as $key => $association) {
            $target = $metadata->associationMappings[$key]['targetEntity'];
            if (strpos($target, 'Interface') === false) {
                $metadata->associationMappings[$key]['targetEntity'] .= 'Interface';
            }
        }

        return $metadata;
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
        $lines[] = ' * ' . $this->getClassName($metadata);
        $lines[] = ' * @codeCoverageIgnore';
        $lines[] = ' */';

        return implode("\n", $lines);
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
            $this->generateEntityRealUse($metadata),
            $this->generateEntityDocBlock($metadata),
            $this->generateEntityClassName($metadata),
            $this->generateEntityBody($metadata)
        );

        $code = str_replace($placeHolders, $replacements, static::$classTemplate);
        $code = str_replace('\\Doctrine\\Common\\Collections\\Collection', 'ArrayCollection', $code);
        $code = str_replace('\\Doctrine\\Common\\Collections\\ArrayCollection', 'ArrayCollection', $code);

        $classTrait = $metadata->name . 'Trait';
        if (trait_exists($classTrait)) {
            if (!class_exists($metadata->name)/* || !in_array($classTrait, class_uses($metadata->name))*/) {
                $classTraitSegments = explode('\\', $classTrait);
                $code = str_replace('<entityTrait>', $this->spaces . 'use ' . end($classTraitSegments) . ";\n", $code);
            }
        }

        if (strpos($code, '<entityTrait>') !== false) {
            $code = str_replace('<entityTrait>', '', $code);
        }

        return str_replace('<spaces>', $this->spaces, $code);
    }

    protected function generateEntityRealUse(ClassMetadata $metadata)
    {
        $useCollections = false;

        foreach ($metadata->associationMappings as $mapping) {
            if ($mapping['mappedBy'] && $mapping['type'] !== ClassMetadataInfo::ONE_TO_ONE) {
                $useCollections = true;
                break;
            }
        }

        $response = [];
        if ($metadata->isMappedSuperclass || $metadata->isEmbeddedClass) {
            $response[] = 'use Assert\Assertion;';
        }

        if (!$metadata->isEmbeddedClass) {
            $response[] = 'use Ivoz\\Core\\Application\\DataTransferObjectInterface;';
        }

        if ($metadata->isMappedSuperclass) {
            $response[] = 'use Ivoz\Core\Domain\Model\ChangelogTrait;';
        }

        if ($useCollections) {
            $response[] = 'use Doctrine\\Common\\Collections\\ArrayCollection;';
            $response[] = 'use Doctrine\\Common\\Collections\\Criteria;';
        }

        return "\n". implode("\n", $response) ."\n";
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
    protected function generateEntityConstructor(ClassMetadataInfo $metadata)
    {
        if ($this->hasMethod('__construct', $metadata)) {
            return '';
        }

        if ($metadata->isEmbeddedClass && $this->embeddablesImmutable) {
            throw new \Exception('override generateEmbeddableConstructor private method');
            //return $this->generateEmbeddableConstructor($metadata);
        }

        $collections = array();
        foreach ($metadata->associationMappings as $mapping) {
            if ($mapping['type'] & ClassMetadataInfo::TO_MANY) {
                $collections[] = '$this->'.$mapping['fieldName'].' = new \Doctrine\Common\Collections\ArrayCollection();';
            }
        }

        list(
            $constructorArguments,
            $voContructor,
            $requiredSetters,
            $requiredGetters,
            $setters,
            $getters,
            $toArray,
            $updateFrom
            ) = $this->getConstructorFields($metadata);

        if (empty($collections) && empty($getters)) {
            return '';
        }

        if ($metadata->isEmbeddedClass || $this->embeddablesImmutable) {
            $response = static::$valueObjectConstructorMethodTemplate;
        } else {
            $response = static::$constructorMethodTemplate;
        }

        $spaces = str_repeat($this->spaces, 2);

        $requiredFields = '';
        $requiredFieldSetters = '';
        $requiredFieldGetters = '';
        $fromDTO = '';
        $updateFromDTO = '';
        $toDTO = '';
        $toArrayGetters = '';
        $propertyMap = '';
        $lineBreak = "\n";

        if (!empty($requiredSetters)) {
            $requiredFields = implode(', ', $constructorArguments);
            $requiredFieldSetters =
                "\n"
                . $this->spaces
                . '$this->'
                . implode("\n" . $this->spaces . '$this->', $requiredSetters);

            if (!empty($requiredGetters)) {
                $requiredFieldGetters .=
                    "\n"
                    . $spaces
                    . '$dto->'
                    . implode(",\n" . $spaces . '$dto->', $requiredGetters);
            }


            if (!empty($voContructor)) {
                foreach ($voContructor as $key => $value) {
                    if (!empty($requiredFieldGetters)) {
                        $requiredFieldGetters .= ",";
                    }

                    $requiredFieldGetters .=
                        "\n"
                        . $spaces
                        . '$'
                        . $key;
                }
            }

            $requiredFieldGetters .= "\n" . $this->spaces . $this->spaces;

            if (strlen($requiredFields) > 40) {
                $requiredFields = "\n". $this->spaces . str_replace(', ', ",\n". $this->spaces, $requiredFields) . "\n";
                $lineBreak = ' ';
            }
        }

        if (is_array($voContructor)) {
            foreach ($voContructor as $key => $value) {
                $voContructor[$key] = implode(' ', $value);
            }

            $voContructor = implode("\n", $voContructor);
            if (!empty($voContructor)) {
                $voContructor = "\n" . $voContructor;
            }
        }

        if (!empty($setters)) {
            $glue = $metadata->isMappedSuperclass
                ? "\n" . $spaces . '->'
                : "\n\n";
            $fromDTO = implode($glue, $setters);

            if ($metadata->isMappedSuperclass) {
                $fromDTO =  "\n" . $spaces . '->' . $fromDTO . "\n" . $this->spaces;
            }
        }

        if (!empty($getters)) {
            $toDTO = "\n" . $spaces . '->' . implode("\n" . $spaces . '->', $getters);
        }

        if (!empty($toArray)) {
            $toArrayGetters = "\n" . $spaces . implode(",\n" . $spaces, $toArray) . "\n" . $this->spaces;
            $propertyMap = "'" . implode("',\n$spaces'", array_keys($toArray)) . "'";
        }

        if (!empty($updateFrom)) {
            $glue = $metadata->isMappedSuperclass
                ? "\n" . $spaces . '->'
                : "\n";
            $updateFromDTO = implode($glue, $updateFrom);
            if ($metadata->isMappedSuperclass) {
                $updateFromDTO =  '$this' . "\n" . $spaces . '->' . $updateFromDTO . ";\n\n";
            }
        }

        if (!empty($requiredFieldSetters)) {
            $response = str_replace('<requiredFieldsSetters>', $requiredFieldSetters, $response);
        } else {
            $response = str_replace("<requiredFieldsSetters>\n", '', $response);
        }

        $response = str_replace('<requiredFields>', $requiredFields, $response);
        $response = str_replace('<requiredFieldsGetters>', $requiredFieldGetters, $response);

        $namespaceSegments = explode('\\', $metadata->namespace);
        $namespace = end($namespaceSegments) . 'Dto';
        $response = str_replace('<dtoClass>', $namespace, $response);
        $response = str_replace('<entityClass>', end($namespaceSegments), $response);

        $response = str_replace('<voContructor>', $voContructor, $response);
        $response = str_replace('<fromDTO>', $fromDTO, $response);
        $response = str_replace('<updateFromDTO>', $updateFromDTO, $response);

        $response = str_replace('<toDTO>', $toDTO, $response);
        $response = str_replace('<lineBreak>', $lineBreak, $response);

        $response = str_replace('<toArray>', $toArrayGetters, $response);
        $response = str_replace('<propertyMap>', $propertyMap, $response);

        if (!empty($collections)) {
            $prefix = empty($requiredSetters) ? $this->spaces : "\n\n" . $this->spaces;
            $response = str_replace(
                "<collections>",
                $prefix . implode("\n" . $this->spaces, $collections),
                $response
            );
        } else {
            $response =  str_replace(
                "<collections>\n",
                '',
                $response
            );
        }

        $response = $this->prefixCodeWithSpaces($response);
        return $response;
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

        $mappings = array_merge($metadata->fieldMappings, $metadata->associationMappings);

        foreach ($mappings as $fieldMapping) {
            $field = (object) $fieldMapping;
            $fieldName = $field->fieldName;
            $attribute = Inflector::camelize($fieldName);

            if (!array_key_exists('options', $fieldMapping)) {
                $fieldMapping['options'] = null;
            }
            $options  = (object) $fieldMapping['options'];

            if (isset($field->targetEntity)) {
                $isOneToOne = ($field->type == ClassMetadataInfo::ONE_TO_ONE);
                if ($isOneToOne && $field->mappedBy) {
                    continue;
                }

                $isOneToMany = ($field->type == ClassMetadataInfo::ONE_TO_MANY);
                if ($isOneToMany) {
                    $dtoGetter = '$dto->get' . Inflector::classify($fieldName) . '()';

                    $updateFrom[] =
                        $this->spaces
                        . 'if (!is_null(' . $dtoGetter . ')) {'
                        . "\n"
                        . str_repeat($this->spaces, 2)
                        . '$this->replace'
                        . Inflector::classify($fieldName)
                        . "(\n"
                        . str_repeat($this->spaces, 3)
                        . '$fkTransformer->transformCollection('
                        . "\n"
                        . str_repeat($this->spaces, 4)
                        . $dtoGetter
                        . "\n"
                        . str_repeat($this->spaces, 3)
                        . ")\n"
                        . str_repeat($this->spaces, 2)
                        . ');'
                        . "\n"
                        . $this->spaces
                        . '}';

                    $setters[$attribute] =
                        $this->spaces
                        . 'if (!is_null(' . $dtoGetter . ')) {'
                        . "\n"
                        . str_repeat($this->spaces, 2)
                        . '$self->replace'
                        . Inflector::classify($fieldName)
                        . "(\n"
                        . str_repeat($this->spaces, 3)
                        . '$fkTransformer->transformCollection('
                        . "\n"
                        . str_repeat($this->spaces, 4)
                        . $dtoGetter
                        . "\n"
                        . str_repeat($this->spaces, 3)
                        . ")\n"
                        . str_repeat($this->spaces, 2)
                        . ');'
                        . "\n"
                        . $this->spaces
                        . '}';
                } else {
                    if (!isset($field->declared)) {
                        $updateFrom[] = 'set' . Inflector::classify($fieldName)
                            . '($dto->get' . Inflector::classify($fieldName) . '())';

                        $setters[$attribute] = 'set' . Inflector::classify($fieldName)
                            . '($dto->get' . Inflector::classify($fieldName) . '())';
                    }
                }

                if (!isset($field->declared) && !$isOneToMany) {
                    $associationToArray = $this
                        ->getConstructorAssociationFields($attribute, $fieldName, $isOneToMany);

                    if (empty($associationToArray)) {
                        continue;
                    }

                    $toArray[] = $associationToArray;

                    $targetEntity = substr($field->targetEntity, 0, -1 * strlen('interface'));

                    $associationGetter =
                        'set' . Inflector::classify($fieldName) . '('
                        . '\\' .$targetEntity . '::entityToDto('
                        . '$this->get' . Inflector::classify($fieldName) . '()'
                        . '))';

                    $getters[$attribute] = $associationGetter;
                }

                continue;
            }

            if (strpos($fieldName, '.') && $metadata->isMappedSuperclass) {
                $segments = explode('.', $fieldName);
                $varName = $segments[0];
                $options = $fieldMapping['options'];
                $addVoContructor = !array_key_exists($varName, $voContructor);

                if ($addVoContructor) {
                    if (!array_key_exists($varName, $voContructor)) {
                        $voContructor[$varName] = [];
                    }
                    $voContructor[$varName][] = $this->getVoConstructor($varName, $metadata->fieldMappings);
                }

                $toArray[] = $this->embeddedToArrayGetter($field->columnName, $segments);
                $setterMethod = 'set' . Inflector::classify($segments[0]);
                if ($segments[0] !== $segments[1]) {
                    $setterMethod .= Inflector::classify($segments[1]);
                }

                $key = $segments[0];
                if ($segments[0] !== $segments[1]) {
                    $key .= ucFirst($segments[1]);
                }

                $getters[$key] =
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
            } elseif (!strpos($fieldName, '.') || $metadata->isMappedSuperclass) {
                if (!isset($field->declared)) {
                    $toArray[]  = '\''. $field->columnName .'\' => self::get' . Inflector::classify($fieldName) . '()';
                    $getters[$attribute] = 'set' . Inflector::classify($fieldName)
                        . '($this->get' . Inflector::classify($fieldName) . '())';
                }

                if ((isset($field->id) && $field->id) || isset($options->defaultValue)) {
                    continue;
                }

                if (!isset($field->declared)) {
                    $updateFrom[] = 'set' . Inflector::classify($fieldName)
                        . '($dto->get' . Inflector::classify($fieldName) . '())';
                }

                if (isset($field->nullable) && $field->nullable && !$metadata->isEmbeddedClass && !isset($field->declared)) {
                    $setters[$attribute] = 'set' . Inflector::classify($fieldName)
                        . '($dto->get' . Inflector::classify($fieldName) . '())';
                    continue;
                }
            }

            if (array_key_exists('originalClass', $fieldMapping) && !isset($field->declared)) {
                $class = substr($fieldMapping['originalClass'], strrpos($fieldMapping['originalClass'], '\\') + 1);

                $declaredField = $fieldMapping['declaredField'];
                $attribute = $class . ' $' . $declaredField;

                $setter = 'set' . Inflector::classify($declaredField) . '($'. $declaredField .');';
                if (end($requiredSetters) !== $setter && $metadata->isMappedSuperclass) {
                    $requiredSetters[$attribute] = $setter;
                }
            } elseif (!isset($field->declared)) {
                $setter = 'set' . Inflector::classify($fieldName) . '($'. $attribute .');';
                $getter = 'get' . Inflector::classify($fieldName) . '()';

                if (!isset($fieldMapping['declared'])) {
                    $requiredSetters[$attribute] = $setter;
                    $requiredGetters[$attribute] = $getter;
                }
            }

            if ($field->type[0] === '\\') {
                $class = substr($field->type, strrpos($field->type, '\\') + 1);
                $attribute = $class. ' $' . $attribute;
            } elseif (strpos($attribute, ' ') === false) {
                $attribute = '$' . $attribute;
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
            $updateFrom
        );
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

        $parentMethodsStr = $this->_generateEntityStubMethods($metadata);
        $parentMethods = !empty($parentMethods)
            ? explode("\n\n", $parentMethodsStr)
            : array();

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
                if ($code = $this->generateEntityStubMethod($metadata, 'get', $associationMapping['fieldName'], 'Doctrine\Common\Collections\ArrayCollection')) {
                    $methods[] = str_replace(
                        '@return array',
                        '@return \\' . $associationMapping['targetEntity'] . '[]',
                        $code
                    );
                }
            }

            if ($associationMapping['type'] & ClassMetadataInfo::TO_ONE) {
                if ($code = $this->generateEntityStubMethod($metadata, 'set', $associationMapping['fieldName'], $associationMapping['targetEntity'])) {
                    $methods[] = $code;
                }

                if ($code = $this->generateEntityStubMethod($metadata, 'get', $associationMapping['fieldName'], $associationMapping['targetEntity'])) {
                    $methods[] = $code;
                }
            }
        }

        $response = array_merge($methods, $parentMethods);

        $stubMethods = implode("\n\n", $response);

        if ($this->codeCoverageIgnoreBlock) {
            $stubMethods = $this->spaces . "// @codeCoverageIgnoreStart\n" . $stubMethods;
            $stubMethods .= $this->spaces . "// @codeCoverageIgnoreEnd";
        }

        return $stubMethods;
    }

    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityLifecycleCallbackMethods(ClassMetadataInfo $metadata)
    {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    protected function _generateEntityStubMethods(ClassMetadataInfo $metadata)
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

        $metadata->fieldMappings = $fieldMappings;
        $metadata->embeddedClasses = $embeddedClasses;
        $methods = array();

        foreach ($metadata->fieldMappings as $fieldMapping) {
            if (isset($fieldMapping['declaredField']) &&
                isset($metadata->embeddedClasses[$fieldMapping['declaredField']])
            ) {
                continue;
            }

            if (isset($fieldMapping['declared']) && $fieldMapping['declared'] !== $metadata->name) {
                continue;
            }

            if ((
                    (!isset($fieldMapping['id']) || !$fieldMapping['id'])
                    && $metadata->generatorType == ClassMetadataInfo::GENERATOR_TYPE_NONE
                ) && (
                    !$metadata->isEmbeddedClass || ! $this->embeddablesImmutable
                )
            ) {
                if ($code = $this->generateEntityStubMethod($metadata, 'set', $fieldMapping['fieldName'], $fieldMapping['type'])) {
                    $methods[] = $code;
                }
            }

            if ($code = $this->generateEntityStubMethod($metadata, 'get', $fieldMapping['fieldName'], $fieldMapping['type'])) {
                $methods[] = $code;
            }
        }

        $metadata->associationMappings = $associationMapping;
        foreach ($metadata->associationMappings as $associationMapping) {
            if (isset($associationMapping['declared'])) {
                continue;
            }

            if ($associationMapping['type'] & ClassMetadataInfo::TO_ONE) {
                $nullable = $this->isAssociationNullable($associationMapping) ? 'null' : null;

                if ($code = $this->generateEntityStubMethod($metadata, 'set', $associationMapping['fieldName'], $associationMapping['targetEntity'], $nullable)) {
                    $methods[] = $code;
                }
                if ($code = $this->generateEntityStubMethod($metadata, 'get', $associationMapping['fieldName'], $associationMapping['targetEntity'])) {
                    $methods[] = $code;
                }
            } elseif ($associationMapping['type'] & ClassMetadataInfo::TO_MANY) {
                if ($code = $this->generateEntityStubMethod($metadata, 'add', $associationMapping['fieldName'], $associationMapping['targetEntity'])) {
                    $methods[] = $code;
                }
                if ($code = $this->generateEntityStubMethod($metadata, 'remove', $associationMapping['fieldName'], $associationMapping['targetEntity'])) {
                    $methods[] = $code;
                }
                if ($code = $this->generateEntityStubMethod($metadata, 'replace', $associationMapping['fieldName'], 'IteratorAggregate')) {
                    $methods[] = $code;
                }
                if ($code = $this->generateEntityStubMethod($metadata, 'get', $associationMapping['fieldName'], 'Doctrine\Common\Collections\ArrayCollection')) {
                    $methods[] = $code;
                }
            }
        }

        $response = array_merge($methods, $parentMethods);

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
        $currentField = null;
        $isNullable = false;
        $visibility = $metadata->isEmbeddedClass
            ? 'protected'
            : 'public';

        if (array_key_exists($fieldName, $metadata->associationMappings)) {
            $currentField = (object) $metadata->associationMappings[$fieldName];
            $isNullable = !$currentField->isOwningSide;
        }

        if (is_null($defaultValue) && $isNullable) {
            $defaultValue = 'null';
        }

        if ($typeHint[0] === '\\') {
            // typehints are always prefixed in parent::generateEntityStubMethod
            $typeHint = substr($typeHint, 1);
        }

        $isCollection = strpos($typeHint, 'Doctrine\\Common\\Collections\\ArrayCollection') !== false;
        if ($isCollection) {
            $typeHint = 'array';
        }

        $parentResponse = parent::generateEntityStubMethod($metadata, $type, $fieldName, $typeHint, $defaultValue);
        $parentResponse = str_replace('(\\' . $metadata->namespace . '\\', '(', $parentResponse);

        $replacements = array(
            '<assertions>' => $this->spaces,
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
        $criteriaArgumentDoc = '';
        $criteriaGetter = '';
        $forcedArray = '';

        if ($isCollection && $type === 'get') {
            $criteriaArgument = 'Criteria $criteria = null';
            $criteriaArgumentDoc = ' @param Criteria | null $criteria';
            $criteriaGetter = "\n";
            $criteriaGetter .= "if (!is_null(\$criteria)) {\n";
            $criteriaGetter .= $this->spaces;
            $criteriaGetter .= 'return $this->'. $fieldName ."->matching(\$criteria)->toArray();\n";
            $criteriaGetter .= "}\n";

            $forcedArray = '->toArray()';

            $criteriaGetter = $this->prefixCodeWithSpaces($criteriaGetter, 2);
        }

        $response = str_replace(
            ['<criteriaArgument>', '<criteriaArgumentDoc>', '<criteriaGetter>', '<forcedArray>'],
            [$criteriaArgument, $criteriaArgumentDoc, $criteriaGetter, $forcedArray],
            $response
        );

        return $response;
    }
}
