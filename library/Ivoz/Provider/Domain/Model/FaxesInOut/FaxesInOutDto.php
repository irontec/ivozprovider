<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

class FaxesInOutDto extends FaxesInOutDtoAbstract
{
    /** @var ?string */
    private $filePath;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'calldate' => 'calldate',
                'src' => 'src',
                'dst' => 'dst',
                'type' => 'type',
                'status' => 'status',
                'file' => [
                    'fileSize',
                    'mimeType',
                    'baseName',
                ],
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);

        if ($context === self::CONTEXT_SIMPLE) {
            $contextProperties['file'][] = 'path';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
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
}
