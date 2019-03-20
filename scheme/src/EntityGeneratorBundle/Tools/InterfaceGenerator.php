<?php

namespace EntityGeneratorBundle\Tools;

use Doctrine\ORM\Tools\EntityGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 * Description of DTOGenerator
 * @codeCoverageIgnore
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class InterfaceGenerator extends EntityGenerator
{
    protected $emptyContent = false;

    public function createEmptyInterfaces()
    {
        $this->emptyContent = true;
    }

    protected $codeCoverageIgnoreBlock = false;

    /**
     * @var string
     */
    protected static $classTemplate =
    '<?php

<namespace>
<useStatement>
<entityClassName>
{
<entityBody>
}
';

    /**
     * {@inheritDoc}
     */
    public function writeEntityClass(ClassMetadataInfo $metadata, $outputDirectory)
    {
        return parent::writeEntityClass($this->transformMetadata($metadata), $outputDirectory);
    }

    /**
     * @var string
     */
    protected static $customMethodTemplate =
        '<docComment><spaces>public <static>function <methodName>(<methodArguments>);';


    protected function transformMetadata(ClassMetadataInfo $metadata)
    {
        $metadata->name = str_replace('Abstract', '', $metadata->name);
        $metadata->name .= 'Interface';
        $metadata->rootEntityName = $metadata->name;
        $metadata->customRepositoryClassName = null;

        foreach ($metadata->associationMappings as $key => $association) {
            $metadata->associationMappings[$key]['targetEntity'] .= 'Interface';
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

        $this->setFieldVisibility(self::FIELD_VISIBLE_PROTECTED);

        $replacements = array(
            $this->generateEntityNamespace($metadata),
            $this->generateEntityRealUse($metadata),
            '',
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
            $isOneToOne = $mapping['type'] === ClassMetadataInfo::ONE_TO_ONE;
            if ($mapping['mappedBy'] && !$isOneToOne) {
                $useCollections = true;
                break;
            }
        }

        $interfaces = $this->getParentInterfaces($metadata);
        $response = array_map(
            function ($item) {
                return 'use ' . $item .  ';';
            },
            $interfaces
        );

        if ($useCollections) {
            $response[] = 'use Doctrine\Common\Collections\Criteria;';
            $response[] = 'use Doctrine\\Common\Collections\\ArrayCollection;';
        }

        return "\n". implode("\n", $response) ."\n";
    }

    /**
     * {@inheritDoc}
     */
    protected function generateEntityClassName(ClassMetadataInfo $metadata)
    {
        if ($this->emptyContent) {
            return
                'interface '
                . $this->getClassName($metadata);
        }

        $interfaces = $this->getParentInterfaces($metadata, false);
        $class =
            'interface '
            . $this->getClassName($metadata)
            . ' extends '
            . implode(', ', $interfaces);

        return $class;
    }

    private function getParentInterfaces(ClassMetadataInfo $metadata, bool $fqdn = true)
    {
        $currentInterface = $metadata->name;
        $defaultImplementationClassName = substr(
            $currentInterface,
            0,
            (-1 * strlen('Interface'))
        );

        $parentInterfaces = [];
        try {
            $defaultImplementationReflection = new \ReflectionClass($defaultImplementationClassName);
            $getChangeSetMethod = $defaultImplementationReflection->getMethod('getChangeSet');

            $parentInterfaces[] = $getChangeSetMethod->isPublic()
                ? 'Ivoz\\Core\\Domain\\Model\\LoggableEntityInterface'
                : 'Ivoz\\Core\\Domain\\Model\\EntityInterface';

            $implementedInterfaces = $defaultImplementationReflection->getInterfaceNames();

            if (!empty($implementedInterfaces)) {
                $parentInterfaces = array_merge(
                    $implementedInterfaces,
                    $parentInterfaces
                );
            }
        } catch (\Exception $e) {
            $parentInterfaces = ['Ivoz\\Core\\Domain\\Model\\EntityInterface'];
        }

        $parentInterfaces = array_filter(
            $parentInterfaces,
            function ($className) use ($currentInterface) {

                if ($className === $currentInterface) {
                    return false;
                }

                return stripos($className, 'Ivoz\\') === 0;
            }
        );

        $potentiallyDuplicated = [];
        foreach ($parentInterfaces as $interfaceFqdn) {
            $interfaceReflection = new \ReflectionClass($interfaceFqdn);
            $interfaces = $interfaceReflection->getInterfaceNames();

            foreach ($interfaces as $item) {
                $potentiallyDuplicated[] = $item;
            }
        }

        $parentInterfaces = array_diff($parentInterfaces, $potentiallyDuplicated);

        if (!$fqdn) {
            $parentInterfaces = array_map(
                function ($item) {
                    $segments = explode('\\', $item);
                    return end($segments);
                },
                $parentInterfaces
            );
        }

        return array_unique($parentInterfaces);
    }

    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityBody(ClassMetadataInfo $metadata)
    {
        if ($this->emptyContent) {
            return '';
        }

        $stubMethods = $this->generateEntityStubMethods ? $this->generateEntityStubMethods($metadata) : null;
        $code = $this->generateEntityFieldMappingProperties($metadata);

        if ($stubMethods) {
            $code[] = $stubMethods;
        }

        return implode("\n", $code);
    }

    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityFieldMappingProperties(ClassMetadataInfo $metadata)
    {
        $constants = [];

        foreach ($metadata->fieldMappings as $fieldMapping) {
            $comment = isset($fieldMapping['options']['comment'])
                ? $fieldMapping['options']['comment']
                : '';

            if (preg_match('/\[enum:(?P<fieldValues>.+)\]/', $comment, $matches)) {
                $acceptedValues = explode('|', $matches['fieldValues']);
                $choices = $this->getEnumConstants($fieldMapping['fieldName'], $acceptedValues);
                foreach ($acceptedValues as $key => $acceptedValue) {
                    $choice = $choices[$key];
                    $constants[] =
                        $this->spaces
                        . 'const '
                        . $choice
                        . " = '${acceptedValue}';";
                }

                $constants[] = "\n";
            }
        }

        return $constants;
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
     * {@inheritDoc}
     */
    protected function generateEntityStubMethods(ClassMetadataInfo $metadata)
    {
        $entityInterfaceMethods = get_class_methods('Ivoz\\Core\\Domain\\Model\\EntityInterface');

        $response = [];

        $className = str_replace('Interface', '', $metadata->getName());
        $reflectionClass = new \ReflectionClass($className);
        $publicMethods = $reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC);

        foreach ($publicMethods as $publicMethod) {
            if ($publicMethod->isConstructor()) {
                continue;
            }

            $methodName = $publicMethod->getName();
            if (in_array($methodName, $entityInterfaceMethods)) {
                continue;
            }

            $docComment = $publicMethod->getDocComment()
                ? $this->spaces . $publicMethod->getDocComment() . "\n"
                : '';

            $methodParameters = $publicMethod->getParameters();

            $methodParameterArray = [];
            foreach ($methodParameters as $methodParameter) {
                $str = '';
                try {
                    $parameterClass = $methodParameter->getClass();
                } catch (\Exception $e) {
                    // Interface does not exist yet
                    continue;
                }

                if ($parameterClass) {
                    $str = '\\' . $parameterClass->getName() . ' ';
                } elseif ($methodParameter->isArray()) {
                    $str = 'array ';
                } elseif ($methodParameter->hasType()) {
                    $str = $methodParameter->getType() . ' ';
                }

                $str .= '$' . $methodParameter->getName();
                if ($methodParameter->isOptional()  && !is_null($methodParameter->getDefaultValue())) {
                    $str .= " = '" . $methodParameter->getDefaultValue() . "'";
                } elseif ($methodParameter->isOptional()) {
                    $str .= " = null";
                }

                $methodParameterArray[] = $str;
            }
            $methodParameterStr = implode(', ', $methodParameterArray);

            $static = $publicMethod->isStatic()
                ? 'static '
                : '';

            $response[$methodName] = str_replace(
                ['<docComment>', '<static>', '<methodName>', '<methodArguments>'],
                [$docComment, $static, $methodName, $methodParameterStr],
                self::$customMethodTemplate
            );
        }

        return implode("\n\n", $response);
    }
}
