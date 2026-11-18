<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Ddi;

final class DdisMassImportResult
{
    public const FILE_LINE = 0;

    private int $createdCount = 0;
    /** @var list<int> */
    private array $updatedLines = [];
    /** @var list<array{line: int, message: string}> */
    private array $skippedRows = [];
    /** @var list<array{line: int, message: string}> */
    private array $errors = [];

    public function addCreated(): void
    {
        $this->createdCount++;
    }

    public function addUpdated(int $line): void
    {
        $this->updatedLines[] = $line;
    }

    public function addSkipped(int $line, string $message): void
    {
        $this->skippedRows[] = [
            'line' => $line,
            'message' => $message,
        ];
    }

    public function addError(int $line, string $message): void
    {
        $this->errors[] = [
            'line' => $line,
            'message' => $message,
        ];
    }

    public function getCreatedCount(): int
    {
        return $this->createdCount;
    }

    /**
     * @return list<int>
     */
    public function getUpdatedLines(): array
    {
        return $this->updatedLines;
    }

    /**
     * @return list<array{line: int, message: string}>
     */
    public function getSkippedRows(): array
    {
        return $this->skippedRows;
    }

    /**
     * @return list<array{line: int, message: string}>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
