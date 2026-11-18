<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class DdisMassImport
{
    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $created;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $updated;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $skipped;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $failed;

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int"
     * )
     */
    protected $updatedLines;

    /**
     * @var DdisMassImportRow[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Model\DdisMassImportRow"
     * )
     */
    protected $skippedRows;

    /**
     * @var DdisMassImportRow[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Model\DdisMassImportRow"
     * )
     */
    protected $errors;

    /**
     * @param int[] $updatedLines
     * @param DdisMassImportRow[] $skippedRows
     * @param DdisMassImportRow[] $errors
     */
    public function __construct(
        int $created,
        array $updatedLines,
        array $skippedRows,
        array $errors
    ) {
        $this->created = $created;
        $this->updated = count($updatedLines);
        $this->skipped = count($skippedRows);
        $this->failed = count($errors);
        $this->updatedLines = $updatedLines;
        $this->skippedRows = $skippedRows;
        $this->errors = $errors;
    }

    /**
     * @return array{
     *     created: int,
     *     updated: int,
     *     skipped: int,
     *     failed: int,
     *     updatedLines: list<int>,
     *     skippedRows: list<array{line: int, message: string}>,
     *     errors: list<array{line: int, message: string}>
     * }
     */
    public function toArray(): array
    {
        return [
            'created' => $this->created,
            'updated' => $this->updated,
            'skipped' => $this->skipped,
            'failed' => $this->failed,
            'updatedLines' => array_values($this->updatedLines),
            'skippedRows' => $this->rowsToArray($this->skippedRows),
            'errors' => $this->rowsToArray($this->errors),
        ];
    }

    /**
     * @param DdisMassImportRow[] $rows
     * @return list<array{line: int, message: string}>
     */
    private function rowsToArray(array $rows): array
    {
        return array_values(
            array_map(
                fn (DdisMassImportRow $row): array => $row->toArray(),
                $rows
            )
        );
    }
}
