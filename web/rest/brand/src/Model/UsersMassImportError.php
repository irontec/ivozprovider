<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class UsersMassImportError
{
    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $line;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $message;

    public function __construct(
        int $line,
        string $message
    ) {
        $this->line = $line;
        $this->message = $message;
    }

    public function getLine(): int
    {
        return $this->line;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array{line: int, message: string}
     */
    public function toArray(): array
    {
        return [
            'line' => $this->line,
            'message' => $this->message,
        ];
    }
}
