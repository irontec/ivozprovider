<?php

namespace EntityGeneratorBundle\Tools;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Tools\EntityGenerator as ParentGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\Common\Util\Inflector;

/**
 * Description of EntityGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class AbstractEntityGenerator extends ParentGenerator
{
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
<requiredFieldsSetters><collections>
}
';

    /**
     * @var string
     */
    protected static $constructorMethodTemplate =
'
/**
 * Changelog tracking purpose
 * @var array
 */
protected $_initialValues = [];

/**
 * Constructor
 */
public function __construct(<requiredFields>)<lineBreak>{
<requiredFieldsSetters><collections>

    $this->initChangelog();
}

/**
 * @param string $fieldName
 * @return mixed
 * @throws \Exception
 */
public function initChangelog()
{
    $values = $this->__toArray();
    if (!$this->getId()) {
        // Empty values for entities with no Id
        foreach ($values as $key => $val) {
            $values[$key] = null;
        }
    }

    $this->_initialValues = $values;
}

/**
 * @param string $fieldName
 * @return mixed
 * @throws \Exception
 */
public function hasChanged($dbFieldName)
{
    if (!array_key_exists($dbFieldName, $this->_initialValues)) {
        throw new \Exception($dbFieldName . \' field was not found\');
    }
    $currentValues = $this->__toArray();

    return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
}

public function getInitialValue($dbFieldName)
{
    if (!array_key_exists($dbFieldName, $this->_initialValues)) {
        throw new \Exception($dbFieldName . \' field was not found\');
    }

    return $this->_initialValues[$dbFieldName];
}

/**
 * @return array
 */
protected function getChangeSet()
{
    $changes = [];
    $currentValues = $this->__toArray();
    foreach ($currentValues as $key => $value) {

        if ($this->_initialValues[$key] == $currentValues[$key]) {
            continue;
        }

        $value = $currentValues[$key];
        if ($value instanceof \DateTime) {
            $value = $value->format(\'Y-m-d H:i:s\');
        }

        $changes[$key] = $value;
    }

    return $changes;
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
    Assertion::isInstanceOf($dto, <dtoClass>::class);
<voContructor>
    $self = new static(<requiredFieldsGetters>);

    return $self<fromDTO>;
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
    Assertion::isInstanceOf($dto, <dtoClass>::class);
<voContructor>
    <updateFromDTO>
    return $this;
}

/**
 * @return <dtoClass>
 */
public function toDTO()
{
    return self::createDTO()<toDTO>;
}

/**
 * @return array
 */
protected function __toArray()
{
    return [<toArray>];
}

';
    /**
     * @var string
     */
    protected static $setMethodTemplate =
'/**
 * <description>
 *
 * @param <variableType> $<variableName>
 *
 * @return self
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
 *
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

        $code = str_replace($placeHolders, $replacements, static::$classTemplate) . "\n";
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

        if ($useCollections) {
            $response[] = 'use Doctrine\\Common\\Collections\\ArrayCollection;';
            $response[] = 'use Doctrine\\Common\\Collections\\Collection;';
            $response[] = 'use Doctrine\\Common\\Collections\\Criteria;';
        }

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
            $lines[] = $this->spaces . ' * @column ' . $field->columnName;
        }

        if (isset($options->comment)) {
            $comment = substr($options->comment, 1, -1);
            $lines[] = $this->spaces . ' * @comment ' . $comment;
        }

        $lines[] = $this->spaces . ' * @var ' . $this->getType($fieldMapping['type']);
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
            if (isset($fieldMapping['options']['default']) && !$isDateType) {
                $classAttr .= ' = ' . var_export($fieldMapping['options']['default'], true);
            }
            $lines[] = $classAttr . ";\n";
        }

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

                $requiredFieldGetters .= "\n" . $this->spaces;
            }

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

        $response = str_replace('<requiredFields>', $requiredFields, $response);
        $response = str_replace('<requiredFieldsSetters>', $requiredFieldSetters, $response);
        $response = str_replace('<requiredFieldsGetters>', $requiredFieldGetters, $response);

        $namespaceSegments = explode('\\', $metadata->namespace);
        $namespace = end($namespaceSegments) . 'DTO';
        $response = str_replace('<dtoClass>', $namespace, $response);

        $response = str_replace('<voContructor>', $voContructor, $response);
        $response = str_replace('<fromDTO>', $fromDTO, $response);
        $response = str_replace('<updateFromDTO>', $updateFromDTO, $response);

        $response = str_replace('<toDTO>', $toDTO, $response);
        $response = str_replace('<lineBreak>', $lineBreak, $response);

        $response = str_replace('<toArray>', $toArrayGetters, $response);

        if (!empty($collections)) {

            $prefix = empty($requiredSetters) ? $this->spaces : "\n\n" . $this->spaces;
            $response = str_replace(
                "<collections>",
                $prefix . implode("\n" . $this->spaces, $collections),
                $response
            );

        } else {

            $response =  str_replace(
                "<collections>",
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
                            . '($dto->get' . Inflector::classify($fieldName) . '())';

                        $setters[$attribute] = 'set' . Inflector::classify($fieldName)
                            . '($dto->get' . Inflector::classify($fieldName) . '())';
                    }
                }

                if (!isset($field->declared)) {
                    $response = $this
                        ->getConstructorAssociationFields($attribute, $fieldName, $isOneToMany);

                    if (empty($response)) {
                        continue;
                    }

                    list($associationToArray, $associationGetterAs) = $response;
                    if (!is_null($associationToArray)) {
                        $toArray[] = $associationToArray;
                    }
                    $getters[$attribute] = $associationGetterAs;
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

            } else if (!strpos($fieldName, '.') || $metadata->isMappedSuperclass) {

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
            } else if (!isset($field->declared)) {

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
            } else if (strpos($attribute, ' ') === false) {
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
                . sprintf($response,$value);

        } else {
            $response = sprintf($response,'');
        }

        return $response;
    }

    /**
     * @param string $attribute
     * @param string $fieldName
     * @param stdClass $field
     * @return string
     * @deprecated
     *
    protected function getFromArrayMethod($attribute, $fieldName, \stdClass $field)
    {
        if (isset($field->mappedBy)) {
            return '';
        }

        return '->set' . ucfirst($attribute) .'('
            . 'isset($data[\'' . $fieldName . '\'])'
            . ' ? '
            . '$data[\'' . $fieldName . '\']'
            . ' : null)';
    }

    /**
     * @param string $attribute
     * @param string $fieldName
     * @return array
     */
    protected function getConstructorAssociationFields($attribute, $fieldName, $isOneToMany)
    {
        $response = [];

        if ($isOneToMany) {

//            $response[] = null;
//            $response[] =
//                'set' . Inflector::classify($fieldName) . '('
//                . '$this->' . $fieldName . '->isInitialized() ? '
//                . '$this->get' . Inflector::classify($fieldName) . '() : null'
//                . ')';

            return $response;
        }

        $response[]  =
            '\'' . $attribute .'Id\' => '
            . 'self::get' . Inflector::classify($fieldName) . '()'
            . ' ? '
            . 'self::get' . Inflector::classify($fieldName) . '()->getId()'
            . ' : null';

        $response[] =
            'set' . Inflector::classify($fieldName) . 'Id('
            . '$this->get' . Inflector::classify($fieldName) . '()'
            . ' ? '
            . '$this->get' . Inflector::classify($fieldName) . '()->getId()'
            . ' : null'
            . ')';

        return $response;
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
                $nullable = $this->isAssociationIsNullable($associationMapping) ? 'null' : null;

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
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityEmbeddedProperties(ClassMetadataInfo $metadata)
    {
        $lines = array();

        foreach ($metadata->embeddedClasses as $fieldName => $embeddedClass) {
            if (
                isset($embeddedClass['declaredField'])
                || isset($embeddedClass['declared'])
                || $this->hasProperty($fieldName, $metadata)
            ) {
                continue;
            }

            $class = $embeddedClass['class'];
            $classSegments = explode('\\', $embeddedClass['class']);
            $embeddedClass['class'] = end($classSegments);

            $embeddedProperties = $this->generateEmbeddedPropertyDocBlock($embeddedClass);
            $embeddedProperties = str_replace('\\' . $embeddedClass['class'] , $embeddedClass['class'] , $embeddedProperties);

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
    protected function generateEntityStubMethod(ClassMetadataInfo $metadata, $type, $fieldName, $typeHint = null,  $defaultValue = null)
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

        $parentResponse = parent::generateEntityStubMethod($metadata, $type, $fieldName, $typeHint,  $defaultValue);
        $parentResponse = str_replace('(\\' . $metadata->namespace . '\\', '(', $parentResponse);

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
                    [$spaces . AssertionGenerator::boolean($currentField->fieldName)]
                );
            }

            $arraySpacerFn = function ($value) use ($spaces) {
                return str_repeat($spaces, 1) . $value;
            };

            if (in_array($currentField->type, ['datetime'])) {

                $integerAssertions = array_map(
                    $arraySpacerFn,
                    $this->getIntegerAssertions($currentField)
                );

                $call = '$var = \\Ivoz\\Core\\Domain\\Model\Helper\\DateTimeHelper::createOrFix('
                    . "\n" . $this->spaces
                    .'$var,'
                    . "\n" . $this->spaces
                    . '$default'
                    . "\n"
                    .');';

                $defaultValue = (isset($currentField->options) && \array_key_exists('default', $currentField->options))
                    ? var_export($currentField->options['default'], true)
                    : "null";

                $assertions[] = str_replace(
                    ['$var', '$default'],
                    ['$' . $currentField->fieldName, $defaultValue],
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

                $assertions[] = AssertionGenerator::choice(
                    $currentField->fieldName,
                    $acceptedValues
                );
            }

            if ($isNullable) {
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

        if (
            !empty($assertions) &&
            isset($currentField->nullable) &&
            $currentField->nullable
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

        if (
            !empty($assertions) &&
            isset($currentField->nullable) &&
            $currentField->nullable
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
