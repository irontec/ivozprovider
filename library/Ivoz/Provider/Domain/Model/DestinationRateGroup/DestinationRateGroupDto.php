<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class DestinationRateGroupDto extends DestinationRateGroupDtoAbstract
{
    const CONTEXTS_WITHOUT_IMPORTER_ARGUMENTS = [
        self::CONTEXT_COLLECTION,
        self::CONTEXT_DETAILED,
        self::CONTEXT_DETAILED_COLLECTION,
    ];


    /** @var ?string */
    private $filePath;

    /**
     * @AttributeDefinition(
     *     type="object",
     *     class="Ivoz\Provider\Domain\Model\DestinationRateGroup\FileImporterArguments",
     *     description="File importer arguments"
     * )
     */
    private ?FileImporterArguments $importerArguments = null;

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'status' => 'status',
                'id' => 'id',
                'name' => ['en', 'es','ca','it'],
                'description' => ['en', 'es','ca','it'],
                'file' => ['fileSize', 'mimeType', 'baseName'],
                'brandId' => 'brand',
                'currencyId' => 'currency'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        $includeImporterArguments = !in_array($context, self::CONTEXTS_WITHOUT_IMPORTER_ARGUMENTS);
        if ($includeImporterArguments) {
            $response['importerArguments'] = [
                'scape',
                'columns',
                'delimiter',
                'enclosure',
                'ignoreFirst',
            ];
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['brandId']);
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        }

        if ($context === self::CONTEXT_SIMPLE) {
            $contextProperties['file'][] = 'path';
        }

        $importerArguments = null;
        $includeImporterArguments = !in_array($context, self::CONTEXTS_WITHOUT_IMPORTER_ARGUMENTS);
        if ($includeImporterArguments && array_key_exists('importerArguments', $contextProperties)) {

            /**
             * @var array{scape?: ?string, columns?: null|array<int, string>, delimiter?: string, enclosure?: string, ignoreFirst?: boolean} $importerArgArray
             */
            $importerArgArray = $data['importerArguments'];

            $importerArguments = new FileImporterArguments(
                $importerArgArray['columns'] ?? null,
                $importerArgArray['delimiter'] ?? ',',
                $importerArgArray['enclosure'] ?? '"',
                $importerArgArray['ignoreFirst'] ?? false,
                $importerArgArray['scape'] ?? null
            );

            unset($data['importerArguments']);
        }

        $this->setByContext(
            $contextProperties,
            $data
        );

        if ($importerArguments) {
            $this->setImporterArguments($importerArguments);
        }
    }

    public function setImporterArguments(FileImporterArguments $importerArguments): static
    {
        $this->importerArguments = $importerArguments;
        $this->setFileImporterArguments(
            $importerArguments->toArray()
        );

        return $this;
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: string}
     */
    public function getFileObjects(): array
    {
        return [
            'file'
        ];
    }

    /**
     * @return self
     */
    public function setFilePath(string $path = null)
    {
        $this->filePath = $path;

        return $this;
    }

    /**
     * @return ?string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = parent::toArray($hideSensitiveData);

        if (is_null($this->importerArguments)) {
            return $response;
        }

        $response['fileImporterArguments'] = $this
            ->importerArguments
            ->toArray();

        return $response;
    }
}
