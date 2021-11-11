<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

class ConferenceRoomDto extends ConferenceRoomDtoAbstract
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
                'maxMembers' => 'maxMembers',
                'pinProtected' => 'pinProtected',
                'pinCode' => 'pinCode',
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }
}
