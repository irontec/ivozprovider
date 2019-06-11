<?php

namespace Ivoz\Provider\Domain\Model\Locution;

class LocutionDto extends LocutionDtoAbstract
{

    private $originalFilePath;
    private $encodedFilePath;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'status' => 'status'
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());
        $response['originalFilePath'] = 'originalFilePath';

        return $response;
    }

    /**
     * @return array
     */
    public function getFileObjects()
    {
        return [
            'originalFile',
            'encodedFile'
        ];
    }

    /**
     * @return mixed
     */
    public function getOriginalFilePath()
    {
        return $this->originalFilePath;
    }

    /**
     * @param string $originalFilePath
     */
    public function setOriginalFilePath(string $originalFilePath = null)
    {
        $this->originalFilePath = $originalFilePath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEncodedFilePath()
    {
        return $this->encodedFilePath;
    }

    /**
     * @param string $encodedFilePath
     */
    public function setEncodedFilePath(string $encodedFilePath = null)
    {
        $this->encodedFilePath = $encodedFilePath;
        return $this;
    }
}
