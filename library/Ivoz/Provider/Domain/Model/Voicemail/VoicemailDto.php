<?php

namespace Ivoz\Provider\Domain\Model\Voicemail;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\VoicemailRelUser\VoicemailRelUserDto;

class VoicemailDto extends VoicemailDtoAbstract
{
    public const CONTEXT_WITH_REL_USERS = 'withRelUsers';

    public const CONTEXTS_WITH_REL_USERS = [
        self::CONTEXT_WITH_REL_USERS,
        self::CONTEXT_DETAILED
    ];

    /**
     * @var int[]
     * @AttributeDefinition (
     *     type="array",
     *     collectionValueType="int",
     *     description="Voicemail rel users"
     * )
     */
    private $relUserIds = [];

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
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $properties = [
                'id' => 'id',
                'enabled' => 'enabled',
                'name' => 'name',
                'email' => 'email',
                'userId' => 'user',
                'residentialDeviceId' => 'residentialDevice',
            ];
        } else {
            $properties = parent::getPropertyMap(...func_get_args());
        }

        if (in_array($context, self::CONTEXTS_WITH_REL_USERS, true)) {
            $properties['relUserIds'] = 'relUserIds';
        }

        if ($role === 'ROLE_COMPANY_USER') {
            unset($properties['userId']);
            unset($properties['relUserIds']);
        }

        return $properties;
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

    /**
     * @param int[] $userIds
     *
     * @return void
     */
    public function setRelUserIds(array $userIds): void
    {
        $this->relUserIds = $userIds;

        $voicemailRelUsers = [];
        foreach ($userIds as $id) {
            $dto = new VoicemailRelUserDto();
            $dto->setUserId($id);
            $dto->setVoicemailId($this->getId());
            $voicemailRelUsers[] = $dto;
        }

        $this->setVoicemailRelUsers($voicemailRelUsers);
    }
}
