<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

class MusicOnHoldDto extends MusicOnHoldDtoAbstract
{

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'status' => 'status'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

    private $originalFilePath;
    private $encodedFilePath;

    /**
     * @return self
     */
    public function setOriginalFilePath(string $path)
    {
        $this->originalFilePath = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalFilePath()
    {
        return $this->originalFilePath;
    }

    /**
     * @return self
     */
    public function setEncodedFilePath(string $path)
    {
        $this->encodedFilePath = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getEncodedFilePath()
    {
        return $this->encodedFilePath;
    }

    public function getFileObjects()
    {
        return [
            'encodedFile',
            'originalFile'
        ];
    }
}
