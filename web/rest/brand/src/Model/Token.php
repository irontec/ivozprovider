<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class Token
{
    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $token;

    public function __construct(string $token)
    {
        $this->setToken($token);
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Token
     */
    private function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }
}
