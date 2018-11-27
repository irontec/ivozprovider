<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

class FaxesInOutDto extends FaxesInOutDtoAbstract
{
    private $filePath;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
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

        return parent::getPropertyMap(...func_get_args());
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
