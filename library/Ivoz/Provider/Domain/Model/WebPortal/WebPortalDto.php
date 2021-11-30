<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

class WebPortalDto extends WebPortalDtoAbstract
{
    /** @var ?string */
    private $logoPath;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'url' => 'url',
                'name' => 'name',
                'urlType' => 'urlType',
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
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
            $contextProperties['logo'][] = 'path';
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
            'logo'
        ];
    }

    /**
     * @return self
     */
    public function setLogoPath(string $path = null)
    {
        $this->logoPath = $path;

        return $this;
    }
    /**
     * @return ?string
     */
    public function getLogoPath()
    {
        return $this->logoPath;
    }
}
