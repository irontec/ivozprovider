<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Ivoz\Provider\Domain\Model\FaxesRelUser\FaxesRelUserDto;
use Ivoz\Api\Core\Annotation\AttributeDefinition;

class FaxDto extends FaxDtoAbstract
{
    const CONTEXT_WITH_REL_USERS = 'withRelUsers';

    public const CONTEXTS_WITH_REL_USERS = [
        self::CONTEXT_WITH_REL_USERS,
        self::CONTEXT_DETAILED
    ];

   /** @var int[]
    * @AttributeDefinition  (
    *     type="array",
    *     collectionValueType="int",
    *     description="Fax rel users"
    * )
    */
    private $relUserIds = [];

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
                'email' => 'email',
                'sendByEmail' => 'sendByEmail',
                'outgoingDdiId' => 'outgoingDdi'
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        if (in_array($context, self::CONTEXTS_WITH_REL_USERS, true)) {
            $response['relUserIds'] = 'relUserIds';
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

        if (in_array($context, self::CONTEXTS_WITH_REL_USERS, true)) {
            $response['relUserIds'] = $this->relUserIds;
        }

        return $response;
    }

    /**
     * @param int[] $userIds
     */
    public function setRelUserIds(array $userIds): void
    {
        $this->relUserIds = $userIds;

        $faxesRelUsers = [];
        foreach ($userIds as $userId) {
            $dto = new FaxesRelUserDto();
            $dto->setUserId($userId);
            $dto->setFaxId($this->getId());
            $faxesRelUsers[] = $dto;
        }

        $this->setFaxesRelUsers($faxesRelUsers);
    }
}
