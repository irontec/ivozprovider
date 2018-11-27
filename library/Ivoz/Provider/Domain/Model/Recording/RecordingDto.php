<?php

namespace Ivoz\Provider\Domain\Model\Recording;

class RecordingDto extends RecordingDtoAbstract
{
    private $recordedFile;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'callid' => 'callid',
                'calldate' => 'calldate',
                'type' => 'type',
                'duration' => 'duration',
                'caller' => 'caller',
                'callee' => 'callee',
                'id' => 'id'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

    public function getFileObjects()
    {
        return [
            'recordedFile'
        ];
    }

    /**
     * @return self
     */
    public function setRecordedFilePath(string $recordedFilePath = null)
    {
        $this->recordedFile = $recordedFilePath;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecordedFilePath()
    {
        return $this->recordedFile;
    }
}
