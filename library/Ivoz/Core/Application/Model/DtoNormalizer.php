<?php

namespace Ivoz\Core\Application\Model;

trait DtoNormalizer
{
    /**
     * @return array
     */
    abstract public function toArray();

    /**
     * @return array
     */
    abstract public static function getPropertyMap(string $context = '');

    /**
     * @inheritdoc
     */
    public function normalize(string $context)
    {
        $response = $this->toArray(true);
        $contextProperties = $this->getPropertyMap($context);

        $response = array_filter(
            $response,
            function ($value, $key) use ($contextProperties) {

                $isEmbedded = is_array($value);

                return
                    in_array($key, $contextProperties, true)
                    || (!$isEmbedded && in_array($value, $contextProperties, true))
                    || ($isEmbedded && in_array($key, array_keys($contextProperties), true));
            },
            ARRAY_FILTER_USE_BOTH
        );

        return $response;
    }

    /**
     * @inheritdoc
     */
    public function denormalize(array $data, string $context)
    {
        $contextProperties = $this->getPropertyMap($context);
        unset($contextProperties['id']);

        $methods = [];
        foreach ($contextProperties as $key => $value) {

            if (is_array($value)) {

                foreach ($value as $property) {
                    $setter = 'set' . ucfirst($key) . ucfirst($property);
                    $dataPath = [
                        $key,
                        $property
                    ];
                    $methods[$setter] =  $dataPath;
                }
            } else if (array_key_exists($value, $data)) {
                $methods['set' . ucfirst($key)] =  [$value];
            }
        }

        foreach ($methods as $setter => $dataPath) {
            $value = $this->getValueFromArray($data, $dataPath);
            $this->{$setter}($value);
        }
    }

    /**
     * @param array $data
     * @param array $dataPath
     * @return mixed
     */
    private function getValueFromArray(array $data, array $dataPath)
    {
        $response = $data;
        foreach ($dataPath as $key) {

            if (!isset($response[$key])) {
                $response = null;
                continue;
            }

            $response = $response[$key];
        }

        return $response;
    }
}