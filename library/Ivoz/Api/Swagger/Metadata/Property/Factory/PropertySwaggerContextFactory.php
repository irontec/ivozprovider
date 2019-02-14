<?php

namespace Ivoz\Api\Swagger\Metadata\Property\Factory;

use Doctrine\Common\Persistence\Mapping\ClassMetadataFactory;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\PropertyMetadata;
use Symfony\Component\PropertyInfo\Type;

class PropertySwaggerContextFactory implements PropertyMetadataFactoryInterface
{
    /**
     * @var ClassMetadataFactory
     */
    private $classMetadataFactory;

    /**
     * @var PropertyMetadataFactoryInterface|null
     */
    private $decorated;

    /**
     * PropertySwaggerContextFactory constructor.
     * @param ClassMetadataFactory $classMetadataFactory
     * @param PropertyMetadataFactoryInterface|null $decorated
     */
    public function __construct(
        ClassMetadataFactory $classMetadataFactory,
        PropertyMetadataFactoryInterface $decorated = null
    ) {
        $this->classMetadataFactory = $classMetadataFactory;
        $this->decorated = $decorated;
    }

    /**
     * @inheritdoc
     */
    public function create(string $resourceClass, string $property, array $options = []): PropertyMetadata
    {
        /** @var PropertyMetadata $propertyMetadata */
        $propertyMetadata = $this->decorated->create(...func_get_args());

        $type = $propertyMetadata->getType();
        if (!$type) {
            return $propertyMetadata;
        }

        $builtinType = $type->getBuiltinType();
        if ($builtinType === Type::BUILTIN_TYPE_OBJECT) {
            $builtinType = $type->getClassName();
        }

        try {
            $metadata = $this->classMetadataFactory->getMetadataFor($resourceClass);
            $fldMetadata = $metadata->getFieldMapping($property);
            $ormType = $fldMetadata['type'];
        } catch (\exception $exception) {
            return $propertyMetadata;
        }

        $hasDefaultValue = isset($fldMetadata['options']) && isset($fldMetadata['options']['default']);
        if ($hasDefaultValue) {
            $propertyMetadata = $this->appendAttributes(
                $propertyMetadata,
                [
                    'swagger_context' => [
                        'default' => $fldMetadata['options']['default']
                    ]
                ]
            );
        }

        $hasComment = isset($fldMetadata['options']) && isset($fldMetadata['options']['comment']);
        if ($hasComment) {
            $comment = $fldMetadata['options']['comment'];
            if (preg_match('/\[enum:(?P<fieldValues>.+)\]/', $comment, $matches)) {
                $acceptedValues = explode('|', $matches['fieldValues']);
                $propertyMetadata = $this->appendAttributes(
                    $propertyMetadata,
                    [
                        'swagger_context' => [
                            'enum' => $acceptedValues
                        ]
                    ]
                );
            }
        }

        return $this->setPropertyFormat(
            $builtinType,
            $ormType,
            $propertyMetadata,
            $fldMetadata
        );
    }

    /**
     * @param PropertyMetadata $propertyMetadata
     * @param $attibutes
     * @return PropertyMetadata
     */
    private function appendAttributes(PropertyMetadata $propertyMetadata, $attibutes)
    {
        $currentAttributes = $propertyMetadata->getAttributes();
        if (!$currentAttributes) {
            $currentAttributes = [];
        }

        return $propertyMetadata->withAttributes(
            array_merge_recursive($currentAttributes, $attibutes)
        );
    }

    /**
     * @param $builtinType
     * @param $ormType
     * @param $propertyMetadata
     * @param $fldMetadata
     * @return PropertyMetadata
     */
    private function setPropertyFormat($builtinType, $ormType, $propertyMetadata, $fldMetadata): PropertyMetadata
    {
        switch ($builtinType) {
            case 'DateTime':
                if ($ormType == 'datetime') {
                    $propertyMetadata = $this->appendAttributes(
                        $propertyMetadata,
                        [
                            'swagger_context' => [
                                'format' => 'date-time'
                            ]
                        ]
                    );
                } elseif ($ormType == 'date') {
                    $propertyMetadata = $this->appendAttributes(
                        $propertyMetadata,
                        [
                            'swagger_context' => [
                                'format' => 'date'
                            ]
                        ]
                    );
                } elseif ($ormType == 'time') {
                    $propertyMetadata = $this->appendAttributes(
                        $propertyMetadata,
                        [
                            'swagger_context' => [
                                'format' => 'time'
                            ]
                        ]
                    );
                }
                break;

            case 'int':
                $isId = isset($fldMetadata['id']) && $fldMetadata['id'];
                $isUnsigned = isset($fldMetadata['options']) && isset($fldMetadata['options']['unsigned']) && $fldMetadata['options']['unsigned'];
                if ($isUnsigned && !$isId) {
                    $propertyMetadata = $this->appendAttributes(
                        $propertyMetadata,
                        [
                            'swagger_context' => [
                                'minimum' => 0
                            ]
                        ]
                    );
                }
                break;

            case 'float':
                $propertyMetadata = $propertyMetadata->withType(
                    new Type(Type::BUILTIN_TYPE_FLOAT)
                );
                $propertyMetadata = $this->appendAttributes(
                    $propertyMetadata,
                    [
                        'swagger_context' => [
                            'format' => 'float'
                        ]
                    ]
                );
                break;

            case 'string':
                if (in_array($ormType, ['string', 'text'])) {
                    if (!isset($fldMetadata['length'])) {
                        break;
                    }

                    $propertyMetadata = $this->appendAttributes(
                        $propertyMetadata,
                        [
                            'swagger_context' => [
                                'maxLength' => $fldMetadata['length']
                            ]
                        ]
                    );
                } elseif ($ormType == 'decimal') {
                    $propertyMetadata = $propertyMetadata->withType(
                        new Type(Type::BUILTIN_TYPE_FLOAT)
                    );
                    $propertyMetadata = $this->appendAttributes(
                        $propertyMetadata,
                        [
                            'swagger_context' => [
                                'format' => 'float'
                            ]
                        ]
                    );
                }
                break;

            case 'bool':
            case 'array':
                break;
        }

        return $propertyMetadata;
    }
}
