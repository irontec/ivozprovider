<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserDto;

class UserDto extends UserDtoAbstract
{
    const CONTEXT_MY_PROFILE = 'myProfile';
    const CONTEXT_PUT_MY_PROFILE = 'updateMyProfile';
    const CONTEXT_WITH_PICKUP_GROUPS = 'withPickupGroups';

    const CONTEXT_TYPES = [
        self::CONTEXT_COLLECTION,
        self::CONTEXT_SIMPLE,
        self::CONTEXT_DETAILED,
        self::CONTEXT_MY_PROFILE,
        self::CONTEXT_PUT_MY_PROFILE,
        self::CONTEXT_WITH_PICKUP_GROUPS
    ];

    const CONTEXTS_WITH_PICKUP_GROUPS = [
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
    protected $pickupGroupIds = [];

    /**
     * @var string
     * @AttributeDefinition(type="string", description="required in order to update user password")
     */
    protected $oldPass;

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

    public function toArray($hideSensitiveData = false)
    {
        $response = parent::toArray($hideSensitiveData);
        if (!$hideSensitiveData) {
            return $response;
        }
        $response['pass'] = '*****';

        return $response;
    }

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'lastname' => 'lastname',
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
                'timezoneId' => 'timezone'
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

    public function normalize(string $context, string $role = '')
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
    public function denormalize(array $data, string $context, string $role = '')
    {
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
        } else {
            if (isset($data['oldPass'])) {
                $this->setOldPass($data['oldPass']);
            } else {
                unset($data['pass']);
            }
        }

        return parent::denormalize($data, $context);
    }

    /**
     * @param int[] $pickupGroupIds
     */
    public function setPickupGroupIds(array $pickupGroupIds)
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
