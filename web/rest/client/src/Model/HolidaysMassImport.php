<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class HolidaysMassImport
{
    /**
     * @var boolean
     * @AttributeDefinition(type="bool")
     */
    protected $success;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $errorMsg;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $failed;

    public function __construct(
        bool $success,
        string $errorMsg,
        int $failed
    ) {
        $this->setSuccess($success);
        $this->setErrorMsg($errorMsg);
        $this->setFailed(
            $failed
        );
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     * @return HolidaysMassImport
     */
    public function setSuccess(bool $success): HolidaysMassImport
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMsg(): string
    {
        return $this->errorMsg;
    }

    /**
     * @param string $errorMsg
     * @return HolidaysMassImport
     */
    public function setErrorMsg(string $errorMsg): HolidaysMassImport
    {
        $this->errorMsg = $errorMsg;
        return $this;
    }

    /**
     * @return int
     */
    public function getFailed(): int
    {
        return $this->failed;
    }

    /**
     * @param int $failed
     * @return HolidaysMassImport
     */
    public function setFailed(int $failed): HolidaysMassImport
    {
        $this->failed = $failed;
        return $this;
    }
}
