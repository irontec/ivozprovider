<?php

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;

/**
* FriendsPatternDtoAbstract
* @codeCoverageIgnore
*/
abstract class FriendsPatternDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $regExp = '';

    /**
     * @var int
     */
    private $id;

    /**
     * @var FriendDto | null
     */
    private $friend;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'regExp' => 'regExp',
            'id' => 'id',
            'friendId' => 'friend'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'regExp' => $this->getRegExp(),
            'id' => $this->getId(),
            'friend' => $this->getFriend()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setRegExp(?string $regExp): static
    {
        $this->regExp = $regExp;

        return $this;
    }

    public function getRegExp(): ?string
    {
        return $this->regExp;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFriend(?FriendDto $friend): static
    {
        $this->friend = $friend;

        return $this;
    }

    public function getFriend(): ?FriendDto
    {
        return $this->friend;
    }

    public function setFriendId($id): static
    {
        $value = !is_null($id)
            ? new FriendDto($id)
            : null;

        return $this->setFriend($value);
    }

    public function getFriendId()
    {
        if ($dto = $this->getFriend()) {
            return $dto->getId();
        }

        return null;
    }
}
