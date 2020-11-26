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
    private $name;

    /**
     * @var string
     */
    private $regExp;

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

    /**
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $regExp | null
     *
     * @return static
     */
    public function setRegExp(?string $regExp = null): self
    {
        $this->regExp = $regExp;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRegExp(): ?string
    {
        return $this->regExp;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param FriendDto | null
     *
     * @return static
     */
    public function setFriend(?FriendDto $friend = null): self
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * @return FriendDto | null
     */
    public function getFriend(): ?FriendDto
    {
        return $this->friend;
    }

    /**
     * @return static
     */
    public function setFriendId($id): self
    {
        $value = !is_null($id)
            ? new FriendDto($id)
            : null;

        return $this->setFriend($value);
    }

    /**
     * @return mixed | null
     */
    public function getFriendId()
    {
        if ($dto = $this->getFriend()) {
            return $dto->getId();
        }

        return null;
    }

}
