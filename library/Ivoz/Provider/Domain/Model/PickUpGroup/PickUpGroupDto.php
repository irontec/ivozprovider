<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserDto;

class PickUpGroupDto extends PickUpGroupDtoAbstract
{
    const CONTEXT_WITH_USERS = 'withUsers';

    const CONTEXTS_WITH_USERS = [
        self::CONTEXT_WITH_USERS,
        self::CONTEXT_DETAILED
    ];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="User ids"
     * )
     */
    protected $userIds = [];

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name'
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());

        if (in_array($context, self::CONTEXTS_WITH_USERS, true)) {
            $response['userIds'] = 'userIds';
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        return $response;
    }

    public function normalize(string $context, string $role = '')
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if (in_array($context, self::CONTEXTS_WITH_USERS, true)) {
            $response['userIds'] = $this->userIds;
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = '')
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

    /**
     * @param int[] $userIds
     */
    public function setUserIds(array $userIds)
    {
        $this->userIds = $userIds;

        $relUsers = [];
        foreach ($userIds as $id) {
            $dto = new PickUpRelUserDto();
            $dto->setUserId($id);
            $relUsers[] = $dto;
        }

        $this->setRelUsers($relUsers);
    }
}
