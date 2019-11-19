<?php

namespace EntityGeneratorBundle\Tools;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Tools\EntityGenerator as ParentGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\Common\Util\Inflector;
use Doctrine\DBAL\Types\Type;

/**
 * Description of EntityGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class AbstractEntityGenerator extends ParentGenerator
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

    protected $skipEmbeddedMethods = false;

    protected $codeCoverageIgnoreBlock = true;

    /**
     * @var string
     */
    protected static $valueObjectConstructorMethodTemplate =
        '
/**
 * Constructor
 */
public function __construct(<requiredFields>)<lineBreak>{
<requiredFieldsSetters>
<collections>
}
';

    /**
     * @var string
     */
    protected static $constructorMethodTemplate =
    '
use ChangelogTrait;

/**
 * Constructor
 */
protected function __construct(<requiredFields>)<lineBreak>{
<requiredFieldsSetters>
<collections>
}

abstract public function getId();

public function __toString()
{
    return sprintf(
        "%s#%s",
        "<classTableName>",
        $this->getId()
    );
}

/**
 * @return void
 * @throws \Exception
 */
protected function sanitizeValues()
{
}

/**
 * @param null $id
 * @return <dtoClass>
 */
public static function createDto($id = null)
{
    return new <dtoClass>($id);
}

/**
 * @internal use EntityTools instead
 * @param <entityClass>Interface|null $entity
 * @param int $depth
 * @return <dtoClass>|null
 */
public static function entityToDto(EntityInterface $entity = null, $depth = 0)
{
    if (!$entity) {
        return null;
    }

    Assertion::isInstanceOf($entity, <entityClass>Interface::class);

    if ($depth < 1) {
        return static::createDto($entity->getId());
    }

    if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
        return static::createDto($entity->getId());
    }

    /** @var <dtoClass> $dto */
    $dto = $entity->toDto($depth-1);

    return $dto;
}

/**
 * Factory method
 * @internal use EntityTools instead
 * @param <dtoClass> $dto
 * @return self
 */
public static function fromDto(
    DataTransferObjectInterface $dto,
    \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
) {
    Assertion::isInstanceOf($dto, <dtoClass>::class);
<voContructor>
    $self = new static(<requiredFieldsGetters>);
<fromDTO>
    $self->initChangelog();

    return $self;
}

/**
 * @internal use EntityTools instead
 * @param <dtoClass> $dto
 * @return self
 */
public function updateFromDto(
    DataTransferObjectInterface $dto,
    \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
) {
    Assertion::isInstanceOf($dto, <dtoClass>::class);
<voContructor>
    <updateFromDTO>

    return $this;
}

/**
 * @internal use EntityTools instead
 * @param int $depth
 * @return <dtoClass>
 */
public function toDto($depth = 0)
{
    return self::createDto()<toDTO>;
}

/**
 * @return array
 */
protected function __toArray()
{
    return [<toArray>];
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
<assertions>$this-><fieldName> = <casting>$<variableName>;

<spaces>return $this;
}
';


    /**
     * @var string
     */
    protected static $getMethodTemplate =
    '/**
 * <description>
 *
 * @return <variableType><nullable>
 */
public function <methodName>(<criteriaArgument>)
{<criteriaGetter>
<spaces>return <prefix>$this-><fieldName><forcedArray><suffix>;
}
';


    /**
     * @var string
     */
    protected static $addMethodTemplate =
    '/**
 * <description>
 *
 * @param <variableType> $<variableName>
 *
 * @return <entity>
 */
<visibility> function <methodName>(<methodTypeHint>$<variableName>)
{
<spaces>$this-><fieldName>->add($<variableName>);

<spaces>return $this;
}';

    /**
     * @var string
     */
    protected static $removeMethodTemplate =
    '/**
 * <description>
 *
 * @param <variableType> $<variableName>
 */
<visibility> function <methodName>(<methodTypeHint>$<variableName>)
{
<spaces>$this-><fieldName>->removeElement($<variableName>);
}';

    /**
     * @var string
     */
    protected static $replaceMethodTemplate =
    '/**
 * <description>
 *
 * @param \<relEntity>[] $<variableName>
 * @return self
 */
<visibility> function <methodName>(Collection $<variableName>)
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
        $code = str_replace('\\Doctrine\\Common\\Collections\\Collection', 'Collection', $code);
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

    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityClassName(ClassMetadataInfo $metadata)
    {
        $className = $this->getClassName($metadata);
        if ($metadata->isEmbeddedClass) {
            return 'class ' . $className;
        }

        $class = 'abstract class '
            . $className
            . ($this->extendsClass() ? ' extends ' . $this->getClassToExtendName() : null);

        return $class;
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
            $response[] = 'use Doctrine\\Common\\Collections\\Collection;';
            $response[] = 'use Doctrine\\Common\\Collections\\Criteria;';
        }

        $response[] = "use Ivoz\\Core\\Domain\\Model\\EntityInterface;";

        return "\n". implode("\n", $response) ."\n";
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
        $options  = (object) $fieldMapping['options'];

        $lines = array();
        $lines[] = $this->spaces . '/**';

        if (strtolower($field->fieldName) !== strtolower($field->columnName)) {
            $lines[] = $this->spaces . ' * column: ' . $field->columnName;
        }

        if (isset($options->comment)) {
            $comment = substr($options->comment, 1, -1);
            $lines[] = $this->spaces . ' * comment: ' . $comment;
        }

        $isNullable = isset($fieldMapping['nullable']) && $fieldMapping['nullable'];
        $lines[] =
            $this->spaces
            . ' * @var '
            . $this->getType($fieldMapping['type'])
            . ($isNullable ? ' | null' : '');

        $lines[] = $this->spaces . ' */';

        return implode("\n", $lines);
    }

    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityFieldMappingProperties(ClassMetadataInfo $metadata)
    {
        $lines = array();

        foreach ($metadata->fieldMappings as $fieldMapping) {
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
            $classAttr = $this->spaces . $this->fieldVisibility . ' $' . $fieldMapping['fieldName'];

            $isDateType = $this->isDateType($fieldMapping['type']);
            $defaultValue = '';
            $isBoolean = $fieldMapping['type'] === 'boolean' ?? false;
            $hasDefaultValue = isset($fieldMapping['options']['default']);

            if ($hasDefaultValue && $isBoolean) {
                $classAttr .= ' = ' . var_export(
                    boolval($fieldMapping['options']['default']),
                    true
                );
            } elseif ($hasDefaultValue && !$isDateType) {
                $classAttr .= ' = ' . var_export($fieldMapping['options']['default'], true);
            }

            $lines[] = $classAttr . ";\n";
        }

        return implode("\n", $lines);
    }


    private function getEnumConstants($fieldName, $acceptedValues, $prefix = '')
    {

        $choices = [];
        foreach ($acceptedValues as $acceptedValue) {
            $choice =
                $prefix
                . strtoupper($fieldName)
                . '_'
                . strtoupper(
                    preg_replace('/[^A-Z0-9]/i', '', $acceptedValue)
                );

            $choices[] = $choice;
        }

        return $choices;
    }

    /**
     * Return class name without Abstract suffix
     *
     * @return string
     */
    protected function getInstanceClassName(ClassMetadataInfo $metadata)
    {
        return substr($this->getClassName($metadata), 0, strlen('Abstract') * -1);
    }

    protected function isDateType(string $type)
    {
        return in_array(
            $type,
            ['datetime', 'time', 'date', ]
        );
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
            $selfGetters,
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
                $this->spaces
                . '$this->'
                . implode("\n". $this->spaces .'$this->', $requiredSetters);

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

            $requiredFieldGetters .= "\n" . $this->spaces;

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

            $fromDTO = "\n" . $this->spaces . '$self' . $fromDTO . ';' . "\n";
        }

        if (!empty($selfGetters)) {
            $toDTO = "\n" . $spaces . '->' . implode("\n" . $spaces . '->', $selfGetters);
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
        $response = str_replace('<classTableName>', $this->getInstanceClassName($metadata), $response);

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
        $selfGetters = [];
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
                        . 'if (' . $dtoGetter . ') {'
                            . "\n"
                            . str_repeat($this->spaces, 2)
                            . '$this->replace'
                            . Inflector::classify($fieldName)
                            . '(' . $dtoGetter . ');'
                            . "\n"
                        . $this->spaces
                        . '}';

                    $setters[$attribute] =
                        $this->spaces
                        . 'if (' . $dtoGetter . ') {'
                            . "\n"
                            . str_repeat($this->spaces, 2)
                            . '$self->replace'
                            . Inflector::classify($fieldName)
                            . '(' . $dtoGetter . ');'
                            . "\n"
                        . $this->spaces
                        . '}';
                } else {
                    if (!isset($field->declared)) {
                        $updateFrom[] = 'set' . Inflector::classify($fieldName)
                            . '($fkTransformer->transform($dto->get' . Inflector::classify($fieldName) . '()))';

                        $setters[$attribute] = 'set' . Inflector::classify($fieldName)
                            . '($fkTransformer->transform($dto->get' . Inflector::classify($fieldName) . '()))';
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
                        . '$this->get' . Inflector::classify($fieldName) . '(), $depth'
                        . '))';

                    $getters[$attribute] = $associationGetter;

                    $associationSelfGetter =
                        'set' . Inflector::classify($fieldName) . '('
                        . '\\' .$targetEntity . '::entityToDto('
                        . 'self::get' . Inflector::classify($fieldName) . '(), $depth'
                        . '))';

                    $selfGetters[$attribute] = $associationSelfGetter;
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

                $selfGetters[$key] =
                    $setterMethod
                    . '(self::get'
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
                    $selfGetters[$attribute] = 'set' . Inflector::classify($fieldName)
                        . '(self::get' . Inflector::classify($fieldName) . '())';
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
            $selfGetters,
            $setters,
            $getters,
            $toArray,
            $updateFrom
        );
    }

    /**
     * @param $segments
     * @param $toArray
     * @return array
     */
    protected function embeddedToArrayGetter($columnName, $segments)
    {
        return
            '\''
            . $segments[0]
            . ucFirst($segments[1])
            . '\' => self::get'
            . Inflector::classify($segments[0])
            . '()->get' . Inflector::classify($segments[1])
            . '()';
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
     * @param string $attribute
     * @param string $fieldName
     * @return string
     */
    protected function getConstructorAssociationFields($attribute, $fieldName, $isOneToMany)
    {
        return
            '\'' . $attribute .'Id\' => '
            . 'self::get' . Inflector::classify($fieldName) . '()'
            . ' ? '
            . 'self::get' . Inflector::classify($fieldName) . '()->getId()'
            . ' : null';
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
        $parentMethods = str_replace('<casting>', '', $parentMethods);

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
                    $code = str_replace('<casting>', $this->getTypeCastingByType($fieldMapping['type'], ($fieldMapping['nullable'] ?? false)), $code);
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
                $nullable = $this->isAssociationIsNullable($associationMapping) ? 'null' : null;

                if ($code = $this->generateEntityStubMethod($metadata, 'set', $associationMapping['fieldName'], $associationMapping['targetEntity'], $nullable)) {
                    $code = str_replace('<casting>', '', $code);
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
                if ($code = $this->generateEntityStubMethod($metadata, 'get', $associationMapping['fieldName'], 'Doctrine\Common\Collections\Collection')) {
                    $methods[] = $code;
                }
            }
        }

        $response = array_merge($methods, $parentMethods);

        $stubMethods = implode("\n", $response);

        if ($this->codeCoverageIgnoreBlock) {
            $stubMethods = $this->spaces . "// @codeCoverageIgnoreStart\n\n" . $stubMethods;
            $stubMethods .=  $this->spaces . "// @codeCoverageIgnoreEnd";
        }

        return $stubMethods;
    }

    private function getTypeCastingByType(string $type, bool $nullable = false): string
    {
        if ($nullable) {
            return '';
        }

        switch ($type) {
            case 'text':
            case 'string':
                return '';
            case 'bigint':
            case 'smallint':
            case 'integer':
                return '(int) ';
            case 'float':
            case 'decimal':
                return '(float) ';
            case 'guid':
            case 'json_array':
            case 'blob':
            case 'datetime':
            case 'time':
            case 'date':
            case 'boolean':
                return '';
        }

        return '';
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
     * @param array             $associationMapping
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateAssociationMappingPropertyDocBlock(array $associationMapping, ClassMetadataInfo $metadata)
    {
        $lines = array();
        $lines[] = $this->spaces . '/**';

        if ($associationMapping['type'] & ClassMetadataInfo::TO_MANY) {
            $lines[] = $this->spaces . ' * @var \Doctrine\Common\Collections\Collection';
        } else {
            $line =
                $this->spaces
                . ' * @var \\'
                . ltrim($associationMapping['targetEntity'], '\\');

            $column = $associationMapping['joinColumns'][0] ?? null;
            $isNullableFk =
                isset($column)
                && (
                    (isset($column['nullable']) && $column['nullable'])
                    || (isset($column['onDelete']) && $column['onDelete'] === 'set null')
                );

            if ($isNullableFk) {
                $line .= ' | null';
            }

            $lines[] = $line;
        }

        $lines[] = $this->spaces . ' */';

        return implode("\n", $lines);
    }

        /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityEmbeddedProperties(ClassMetadataInfo $metadata)
    {
        $lines = array();

        foreach ($metadata->embeddedClasses as $fieldName => $embeddedClass) {
            if (isset($embeddedClass['declaredField'])
                || isset($embeddedClass['declared'])
                || $this->hasProperty($fieldName, $metadata)
            ) {
                continue;
            }

            $classSegments = explode('\\', $embeddedClass['class']);
            $embeddedClass['class'] = end($classSegments);

            $embeddedProperties = $this->generateEmbeddedPropertyDocBlock($embeddedClass);
            $embeddedProperties = str_replace('\\' . $embeddedClass['class'], $embeddedClass['class'], $embeddedProperties);

            $lines[] = $embeddedProperties;
            $lines[] = $this->spaces . $this->fieldVisibility . ' $' . $fieldName . ";\n";
        }

        return implode("\n", $lines);
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
    protected function isAssociationIsNullable($associationMapping)
    {
        $isOneToOne = $associationMapping['type'] === ClassMetadataInfo::ONE_TO_ONE;
        if ($associationMapping['inversedBy'] && !$isOneToOne) {
            return true;
        }

        if ($isOneToOne) {
            return !$associationMapping['isOwningSide'];
        }

        return parent::isAssociationIsNullable($associationMapping);
    }

    /**
     * {@inheritDoc}
     */
    protected function generateEntityStubMethod(ClassMetadataInfo $metadata, $type, $fieldName, $typeHint = null, $defaultValue = null)
    {
        $currentField = null;
        $isNullable = false;
        $isNullableFk = false;
        $visibility = 'protected';

        if (array_key_exists($fieldName, $metadata->fieldMappings)) {
            $currentField = (object) $metadata->fieldMappings[$fieldName];
            $isNullable = isset($currentField->nullable) && $currentField->nullable;
        } elseif (array_key_exists($fieldName, $metadata->associationMappings)) {
            $currentAsoc = (object) $metadata->associationMappings[$fieldName];
            $isNullableFk =
                isset($currentAsoc->joinColumns)
                && isset($currentAsoc->joinColumns[0])
                && (
                    (isset($currentAsoc->joinColumns[0]['nullable']) && $currentAsoc->joinColumns[0]['nullable'])
                    || (isset($currentAsoc->joinColumns[0]['onDelete']) && $currentAsoc->joinColumns[0]['onDelete'] === 'set null')
                );
        }

        if (is_null($defaultValue) && ($isNullable || $isNullableFk)) {
            $defaultValue = 'null';
        }

        if ($typeHint[0] === '\\') {
            // typehints are always prefixed in parent::generateEntityStubMethod
            $typeHint = substr($typeHint, 1);
        }

        $isFk = strpos($typeHint, '\\');
        if ($isFk) {
            $visibility = 'public';
        }

        $isCollection = strpos($typeHint, 'Doctrine\\Common\\Collections\\Collection') !== false;
        if ($isCollection) {
            $typeHint = 'array';
        }

        $parentResponse = parent::generateEntityStubMethod($metadata, $type, $fieldName, $typeHint, $defaultValue);
        $parentResponse = str_replace('(\\' . $metadata->namespace . '\\', '(', $parentResponse);

        $prefix = '';
        $suffix = '';

        $isNullableFk = false;
        if (array_key_exists($fieldName, $metadata->associationMappings)) {
            $currentAsoc = (object) $metadata->associationMappings[$fieldName];
            $isNullableFk =
                isset($currentAsoc->joinColumns)
                && isset($currentAsoc->joinColumns[0])
                && (
                    (isset($currentAsoc->joinColumns[0]['nullable']) && $currentAsoc->joinColumns[0]['nullable'])
                    || (isset($currentAsoc->joinColumns[0]['onDelete']) && $currentAsoc->joinColumns[0]['onDelete'] === 'set null')
                );
        }

        $assertions = [];

        if ($currentField) {
            $comment = '';
            if (isset($currentField->options) && isset($currentField->options['comment'])) {
                $comment = $currentField->options['comment'];
            }

            $spaces = '';
            if ($isNullable) {
                $spaces = str_repeat(' ', 4);
            }

            if (!$isNullable) {
                $assertions[] = $spaces . AssertionGenerator::notNull($fieldName);
            } else {
                $assertions[] = 'if (!is_null($' . $fieldName . ')) {';
            }


            if (in_array($currentField->type, ['boolean'])) {
                $assertions = array_merge(
                    $assertions,
                    [$spaces . AssertionGenerator::boolean($currentField->fieldName, $spaces)]
                );

                $isNullable = isset($currentField->nullable) && $currentField->nullable;
            }

            $arraySpacerFn = function ($value) use ($spaces) {
                return str_repeat($spaces, 1) . $value;
            };

            if (in_array($currentField->type, ['datetime'])) {
                if ($isNullable) {
                    $prefix = '!is_null($this->' . Inflector::camelize($fieldName) . ') ? clone ';
                    $suffix = ' : null';
                } else {
                    $prefix = 'clone ';
                }

                $indent = ($isNullable)
                    ? str_repeat(' ', 4)
                    : '';

                $call = $indent . '$var = \\Ivoz\\Core\\Domain\\Model\Helper\\DateTimeHelper::createOrFix('
                    . "\n" . $this->spaces
                    . $indent .'$var,'
                    . "\n" . $this->spaces
                    . $indent . '$default'
                    . "\n"
                    . $indent .');'
                    . "\n\n"
                    . $indent .'if ($this->$fldName == $var) {'
                    . "\n"
                    . $indent . '    return $this;'
                    . "\n"
                    . $indent ."}"
                ;

                $defaultValue = (isset($currentField->options) && \array_key_exists('default', $currentField->options))
                    ? var_export($currentField->options['default'], true)
                    : "null";

                if ($defaultValue === "NULL") {
                    $defaultValue = "null";
                }

                $assertions[] = str_replace(
                    ['$var', '$fldName', '$default'],
                    ['$' . $currentField->fieldName, $currentField->fieldName, $defaultValue],
                    $call
                );
            }

            if (in_array($currentField->type, ['smallint', 'integer', 'bigint'])) {
                $integerAssertions = $this->getIntegerAssertions($currentField);
                $integerAssertions = array_map($arraySpacerFn, $integerAssertions);

                $assertions = array_merge(
                    $assertions,
                    $integerAssertions
                );
            }

            if (in_array($currentField->type, ['decimal', 'float'])) {
                $floatAssertions = $this->getFloatAssertions($currentField);
                $floatAssertions = array_map($arraySpacerFn, $floatAssertions);

                $assertions = array_merge(
                    $assertions,
                    $floatAssertions
                );
            }

            if (in_array($currentField->type, ['string', 'text'])) {
                $stringAssertions = $this->getStringAssertions($currentField);
                $stringAssertions = array_map($arraySpacerFn, $stringAssertions);
                $assertions = array_merge(
                    $assertions,
                    $stringAssertions
                );
            }

            if (preg_match('/\[enum:(?P<fieldValues>.+)\]/', $comment, $matches)) {
                $acceptedValues = explode('|', $matches['fieldValues']);
                $entityFqdn = substr(
                    $metadata->name,
                    0,
                    strlen('Abstract') * -1
                );

                $entityFqdnSegments = explode('\\', $entityFqdn);
                $interface = end($entityFqdnSegments) . 'Interface';

                $choices = $this->getEnumConstants($currentField->fieldName, $acceptedValues, $interface . '::');

                $glue = "\n" . $this->spaces;
                $assertions[] = AssertionGenerator::choice(
                    $currentField->fieldName,
                    "[$glue". implode(',' . $glue, $choices) . "\n]",
                    $isNullable
                );
            }

            if ($isNullable && count($assertions) === 1) {
                $assertions = [];
            } elseif ($isNullable) {
                $assertions[] = '}';
            }
        }

        if (!empty($assertions)) {
            $assertions = $this->prefixCodeWithSpaces(implode("\n", $assertions), 2);
            $assertions = $assertions . "\n\n". str_repeat($this->spaces, 2);
        } else {
            $assertions =  str_repeat($this->spaces, 2);
        }

        $replacements = array(
            $this->spaces . '<assertions>' => $assertions,
            '<visibility>' => $visibility,
            '<nullable>' => ($isNullable || $isNullableFk) ? ' | null' : '',
            '<prefix>'             => $prefix,
            '<suffix>'             => $suffix,
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

    private function getFloatAssertions($currentField)
    {
        $assertions = [];
        if (!isset($currentField->options)) {
            $currentField->options = [];
        }
        $options = (object) $currentField->options;

        $assertions[] = AssertionGenerator::float($currentField->fieldName);


        if (isset($options->unsigned) && $options->unsigned) {
            $assertions[] = AssertionGenerator::greaterOrEqualThan($currentField->fieldName, 0);
        }

        $isNullable = isset($currentField->nullable) && $currentField->nullable;
        if ($isNullable) {
            $assertions[] = '$' . $currentField->fieldName . ' = (float) $' . $currentField->fieldName . ';';
        }

        if (!empty($assertions) && $isNullable
        ) {
            foreach ($assertions as $key => $value) {
                $assertions[$key] = $this->spaces . $assertions[$key];
            }

            array_unshift(
                $assertions,
                AssertionGenerator::notNullCondition($currentField->fieldName)
            );
            $assertions[] = '}';
        }

        return $assertions;
    }

    private function getIntegerAssertions($currentField)
    {
        $assertions = [];
        if (!isset($currentField->options)) {
            $currentField->options = [];
        }
        $options = (object) $currentField->options;

        $assertions[] = AssertionGenerator::integer($currentField->fieldName);

        if (isset($options->unsigned) && $options->unsigned) {
            $assertions[] = AssertionGenerator::greaterOrEqualThan($currentField->fieldName, 0);
        }

        $isNullable = isset($currentField->nullable) && $currentField->nullable;
        if ($isNullable) {
            $assertions[] = '$' . $currentField->fieldName . ' = (int) $' . $currentField->fieldName . ';';
        }

        return $assertions;
    }

    private function getStringAssertions($currentField)
    {
        $assertions = [];
        if (isset($currentField->length)) {
            $assertions[] = AssertionGenerator::maxLength(
                $currentField->fieldName,
                $currentField->length
            );
        }

        return $assertions;
    }
}
