<?php

namespace Ivoz\Provider\Domain\Model\Location;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\User\UserDto;

class LocationDto extends LocationDtoAbstract
{
    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int"
     * )
     */
    protected array $userIds = [];

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
                'description' => 'description',
                'survivalDevice' => 'survivalDevice',
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
            $response['userIds'] = 'userIds';
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

    /**
     * @return array<array-key, mixed>
     */
    public function normalize(string $context, string $role = ''): array
    {
        $response = parent::normalize($context, $role);

        $response['userIds'] = $this->userIds;

        return $response;
    }

    /**
     * @param int[] $userIds
     */
    public function setUserIds(array $userIds): void
    {
        $this->userIds = $userIds;

        $users = [];
        foreach ($userIds as $id) {
            $dto = new UserDto($id);
            $users[] = $dto;
        }

        $this->setUsers($users);
    }
}
