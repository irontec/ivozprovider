<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class FileImporterArguments
{
    /**
     * @var string | null
     * @AttributeDefinition(type="string")
     */
    private ?string $scape;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private string $delimiter;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private string $enclosure;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private bool $ignoreFirst;

    /** @var String[] $columns */
    private ?array $columns;

    /**
     * @param String[] $columns
     */
    public function __construct(
        ?array $columns = null,
        string $delimiter = ",",
        string $enclosure = "\"",
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
     * @return array<string, string[]|string|bool|null>
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
