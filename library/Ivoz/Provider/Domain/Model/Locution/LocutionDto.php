<?php

namespace Ivoz\Provider\Domain\Model\Locution;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

class LocutionDto extends LocutionDtoAbstract
{

    private $originalFilePath;
    private $encodedFilePath;

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


