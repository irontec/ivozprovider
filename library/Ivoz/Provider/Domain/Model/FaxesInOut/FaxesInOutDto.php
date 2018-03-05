<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

class FaxesInOutDto extends FaxesInOutDtoAbstract
{
    private $filePath;

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'calldate' => 'calldate',
                'src' => 'src',
                'dst' => 'dst',
                'type' => 'type',
                'status' => 'status'
            ];
        }

        return [
            'calldate' => 'calldate',
            'src' => 'src',
            'dst' => 'dst',
            'type' => 'type',
            'pages' => 'pages',
            'status' => 'status',
            'id' => 'id',
            'file' => ['fileSize','mimeType','baseName'],
            'faxId' => 'fax',
            'dstCountryId' => 'dstCountry'
        ];
    }

    public function getFileObjects()
    {
        return [
            'file'
        ];
    }

    /**
     * @return self
     */
    public function setFilePath(string $path = null)
    {
        $this->filePath = $path;

        return $this;
    }
    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }
}


