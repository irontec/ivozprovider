<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class ExtensionsMassImport
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

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): ExtensionsMassImport
    {
        $this->success = $success;
        return $this;
    }

    public function getErrorMsg(): string
    {
        return $this->errorMsg;
    }

    public function setErrorMsg(string $errorMsg): self
    {
        $this->errorMsg = $errorMsg;
        return $this;
    }

    public function getFailed(): int
    {
        return $this->failed;
    }

    public function setFailed(int $failed): self
    {
        $this->failed = $failed;
        return $this;
    }
}
