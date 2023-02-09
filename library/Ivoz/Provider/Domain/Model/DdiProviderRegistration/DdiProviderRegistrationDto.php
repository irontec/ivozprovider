<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Kam\Domain\Model\TrunksUacreg\DdiProviderRegistrationStatus;

class DdiProviderRegistrationDto extends DdiProviderRegistrationDtoAbstract
{
    /**
     * @var ?DdiProviderRegistrationStatus
     * @AttributeDefinition(
     *     type="object",
     *     class="Ivoz\Kam\Domain\Model\TrunksUacreg\DdiProviderRegistrationStatus",
     *     description="Registration status"
     * )
     */
    private $status;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        $response =  parent::getPropertyMap(...func_get_args());

        if ($context === self::CONTEXT_DETAILED_COLLECTION) {
            return [
                'id' => 'id',
                'username' => 'username',
                'domain' => 'domain',
                'status' => [
                    'registered',
                    'inProgress',
                    'expires'
                ]
            ];
        }

        // Remove application entity relation
        unset($response['trunksUacregId']);

        return $response;
    }


    public function normalize(string $context, string $role = ''): array
    {
        $response = parent::normalize(...func_get_args());

        if (!isset($response['status'])) {
            return $response;
        }

        /**
         * @var DdiProviderRegistrationStatus $status
         */
        $status = $response['status'];
        $response['status'] = $status->toArray();

        return $response;
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = parent::toArray($hideSensitiveData);
        $response['status'] = $this->status;

        return $response;
    }

    public function setStatus(DdiProviderRegistrationStatus $status): static
    {
        $this->status = $status;

        return $this;
    }
}
