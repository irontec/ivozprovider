<?php

namespace Ivoz\Provider\Domain\Model\Webhook;

class WebhookDto extends WebhookDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'name' => 'name',
                'uri' => 'uri',
                'eventStart' => 'eventStart',
                'eventRing' => 'eventRing',
                'eventAnswer' => 'eventAnswer',
                'eventEnd' => 'eventEnd',
                'template' => 'template',
                'description' => 'description',
                'id' => 'id',
            ];
        }

        $response = parent::getPropertyMap($context, $role);

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['brandId']);
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
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

        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }
}
