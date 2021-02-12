<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class UsersMassImport
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
        int $imported
    ) {
        $this->setSuccess($success);
        $this->setErrorMsg($errorMsg);
        $this->setFailed(
            $imported
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
     * @return UsersMassImport
     */
    public function setSuccess(bool $success): UsersMassImport
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
     * @return UsersMassImport
     */
    public function setErrorMsg(string $errorMsg): UsersMassImport
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
     * @return UsersMassImport
     */
    public function setFailed(int $failed): UsersMassImport
    {
        $this->failed = $failed;
        return $this;
    }
}
