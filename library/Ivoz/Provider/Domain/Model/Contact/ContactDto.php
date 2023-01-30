<?php

namespace Ivoz\Provider\Domain\Model\Contact;

class ContactDto extends ContactDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'lastname' => 'lastname',
                'email' => 'email',
                'workPhoneE164' => 'workPhoneE164',
                'mobilePhoneE164' => 'mobilePhoneE164',
                'otherPhone' => 'otherPhone',
                'userId' => 'user',
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        return $response;
    }

    private function filterUserContactReadOnlyFields(array $data): array
    {
        $readOnlyFlds = [
            'name',
            'lastname',
            'email',
            'otherPhone',
        ];

        if (!$data['user']) {
            return $data;
        }

        foreach ($readOnlyFlds as $readOnlyFld) {
            if (!isset($data[$readOnlyFld])) {
                continue;
            }

            unset($data[$readOnlyFld]);
        }

        return $data;
    }


    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
            $data = $this->filterUserContactReadOnlyFields($data);
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }
}
