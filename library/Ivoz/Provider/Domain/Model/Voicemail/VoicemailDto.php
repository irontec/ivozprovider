<?php

namespace Ivoz\Provider\Domain\Model\Voicemail;

class VoicemailDto extends VoicemailDtoAbstract
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
                'enabled' => 'enabled',
                'name' => 'name',
                'email' => 'email',
                'userId' => 'user',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

    /**
     * @param array<array-key, mixed> $data
     */
    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($contextProperties['userId']);
            unset($contextProperties['residentialDeviceId']);
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }
}
