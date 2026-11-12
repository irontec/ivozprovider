<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Contact;

final class ContactsMassImportResult
{
    public const FILE_LINE = 0;

    /** @var list<array{line: int, message: string}> */
    private array $errors = [];
    private int $createdCount = 0;
    private int $updatedCount = 0;

    public function addError(int $line, string $message): void
    {
        $this->errors[] = [
            'line' => $line,
            'message' => $message,
        ];
    }

    public function addCreatedContact(): void
    {
        $this->createdCount++;
    }

    public function addUpdatedContact(): void
    {
        $this->updatedCount++;
    }

    /**
     * @return list<array{line: int, message: string}>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getCreatedCount(): int
    {
        return $this->createdCount;
    }

    public function getUpdatedCount(): int
    {
        return $this->updatedCount;
    }
}
