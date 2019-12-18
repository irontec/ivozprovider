<?php

namespace Ivoz\Api\Entity\Serializer\Normalizer;

interface DateTimeNormalizerInterface
{
    public function normalize($class, $fieldName, \DateTimeInterface $value);

    public function denormalize($class, $fieldName, $value = null);
}
