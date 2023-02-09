<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserDto;

class UserDto extends UserDtoAbstract
{
    protected $sensitiveFields = [
        'pass',
    ];

    public const CONTEXT_MY_PROFILE = 'myProfile';
    public const CONTEXT_PUT_MY_PROFILE = 'updateMyProfile';
    public const CONTEXT_WITH_PICKUP_GROUPS = 'withPickupGroups';

    public const CONTEXT_TYPES = [
        self::CONTEXT_COLLECTION,
        self::CONTEXT_SIMPLE,
        self::CONTEXT_DETAILED,
        self::CONTEXT_MY_PROFILE,
        self::CONTEXT_PUT_MY_PROFILE,
        self::CONTEXT_WITH_PICKUP_GROUPS
    ];

    public const CONTEXTS_WITH_PICKUP_GROUPS = [
        self::CONTEXT_WITH_PICKUP_GROUPS,
        self::CONTEXT_DETAILED
    ];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Pickup group ids"
     * )
     */
    private $pickupGroupIds = [];

    /**
     * @var string
     * @AttributeDefinition(type="string", description="required in order to update user password")
     */
    private $oldPass;

    /**
     * @return string
     */
    public function getOldPass()
    {
        return $this->oldPass;
    }

    /**
     * @param string $oldPass
     * @return UserDto
     */
    public function setOldPass($oldPass)
    {
        $this->oldPass = $oldPass;
        return $this;
    }

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'lastname' => 'lastname',
                'terminalId' => 'terminal',
                'extensionId' => 'extension',
                'outgoingDdiId' => 'outgoingDdi',
            ];

            if ($role === 'ROLE_BRAND_ADMIN') {
                $response['companyId'] = 'company';
            }

            return $response;
        }

        if ($context === self::CONTEXT_MY_PROFILE) {
            return [
                'id' => 'id',
                'name' => 'name',
                'lastname' => 'lastname',
                'email' => 'email',
                'doNotDisturb' => 'doNotDisturb',
                'isBoss' => 'isBoss',
                'maxCalls' => 'maxCalls',
                'bossAssistantId' => 'bossAssistant',
                'timezoneId' => 'timezone',
            ];
        }

        if ($context === self::CONTEXT_PUT_MY_PROFILE) {
            return [
                'name' => 'name',
                'pass' => 'pass',
                'oldPass' => 'oldPass',
                'lastname' => 'lastname',
                'email' => 'email',
                'doNotDisturb' => 'doNotDisturb',
                'isBoss' => 'isBoss',
                'maxCalls' => 'maxCalls',
                'bossAssistantId' => 'bossAssistant',
                'timezoneId' => 'timezone'
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());
        if ($role !== 'ROLE_COMPANY_ADMIN') {
            $response['oldPass'] = 'oldPass';
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        if (in_array($context, self::CONTEXTS_WITH_PICKUP_GROUPS, true)) {
            $response['pickupGroupIds'] = 'pickupGroupIds';
        }

        return $response;
    }

    public function normalize(string $context, string $role = ''): array
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if (in_array($context, self::CONTEXTS_WITH_PICKUP_GROUPS, true)) {
            $response['pickupGroupIds'] = $this->pickupGroupIds;
        }

        return $response;
    }

    /**
     * @inheritdoc
     */
    public function denormalize(array $data, string $context, string $role = ''): void
    {
        if ($role !== 'ROLE_COMPANY_ADMIN') {
            if (isset($data['oldPass'])) {
                $this->setOldPass($data['oldPass']);
            } else {
                unset($data['pass']);
            }
        }

        parent::denormalize($data, $context);
    }

    /**
     * @param int[] $pickupGroupIds
     *
     * @return void
     */
    public function setPickupGroupIds(array $pickupGroupIds): void
    {
        $this->pickupGroupIds = $pickupGroupIds;

        $relPickupGroups = [];
        foreach ($pickupGroupIds as $id) {
            $dto = new PickUpRelUserDto();
            $dto->setPickUpGroupId($id);
            $relPickupGroups[] = $dto;
        }

        $this->setPickUpRelUsers($relPickupGroups);
    }
}
