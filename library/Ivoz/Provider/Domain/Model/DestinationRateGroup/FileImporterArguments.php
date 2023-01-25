<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class FileImporterArguments
{
    /**
     * @var string | null
     * @AttributeDefinition(type="string")
     */
    private $scape;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $delimiter;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $enclosure;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $ignoreFirst;

    /** @var null|String[] $columns */
    private $columns;

    /**
     * @param String[] $columns
     */
    public function __construct(
        ?array $columns = null,
        string $delimiter = ',',
        string $enclosure = '"',
        bool $ignoreFirst = true,
        ?string $scape = null
    ) {
        $this->columns = $columns;
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->ignoreFirst = $ignoreFirst;
        $this->scape = $scape;
    }

    /**
     * @return array{scape: ?string, columns: null|array<array-key, string>, delimiter: string, enclosure: string, ignoreFirst: boolean}
     */
    public function toArray(): array
    {
        return [
            'scape' => $this->getScape(),
            'columns' => $this->getColumns(),
            'delimiter' => $this->getDelimiter(),
            'enclosure' => $this->getEnclosure(),
            'ignoreFirst' => $this->getIgnoreFirst()
        ];
    }

    private function getScape(): ?string
    {
        return $this->scape;
    }

    /**
     * @return string[]
     */
    private function getColumns(): ?array
    {
        return $this->columns;
    }

    private function getDelimiter(): string
    {
        return $this->delimiter;
    }

    private function getEnclosure(): string
    {
        return $this->enclosure;
    }

    private function getIgnoreFirst(): bool
    {
        return $this->ignoreFirst;
    }
}
