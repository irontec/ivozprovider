<?php

namespace Ivoz\Provider\Domain\Model\UsersCdr;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrDto;

/**
* UsersCdrDtoAbstract
* @codeCoverageIgnore
*/
abstract class UsersCdrDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $startTime = '2000-01-01 00:00:00';

    /**
     * @var float|null
     */
    private $duration = 0;

    /**
     * @var string|null
     */
    private $direction = 'outbound';

    /**
     * @var string|null
     */
    private $caller = null;

    /**
     * @var string|null
     */
    private $callee = null;

    /**
     * @var string|null
     */
    private $owner = null;

    /**
     * @var string|null
     */
    private $callid = null;

    /**
     * @var int|null
     */
    private $brandId = null;

    /**
     * @var string|null
     */
    private $disposition = 'answered';

    /**
     * @var int|null
     */
    private $numRecordings = 0;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var UserDto | null
     */
    private $user = null;

    /**
     * @var FriendDto | null
     */
    private $friend = null;

    /**
     * @var ExtensionDto | null
     */
    private $extension = null;

    /**
     * @var UsersCdrDto | null
     */
    private $kamUsersCdr = null;

    public function __construct(?int $id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'startTime' => 'startTime',
            'duration' => 'duration',
            'direction' => 'direction',
            'caller' => 'caller',
            'callee' => 'callee',
            'owner' => 'owner',
            'callid' => 'callid',
            'brandId' => 'brandId',
            'disposition' => 'disposition',
            'numRecordings' => 'numRecordings',
            'id' => 'id',
            'companyId' => 'company',
            'userId' => 'user',
            'friendId' => 'friend',
            'extensionId' => 'extension',
            'kamUsersCdrId' => 'kamUsersCdr'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'startTime' => $this->getStartTime(),
            'duration' => $this->getDuration(),
            'direction' => $this->getDirection(),
            'caller' => $this->getCaller(),
            'callee' => $this->getCallee(),
            'owner' => $this->getOwner(),
            'callid' => $this->getCallid(),
            'brandId' => $this->getBrandId(),
            'disposition' => $this->getDisposition(),
            'numRecordings' => $this->getNumRecordings(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'user' => $this->getUser(),
            'friend' => $this->getFriend(),
            'extension' => $this->getExtension(),
            'kamUsersCdr' => $this->getKamUsersCdr()
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

    public function setStartTime(\DateTimeInterface|string $startTime): static
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getStartTime(): \DateTimeInterface|string|null
    {
        return $this->startTime;
    }

    public function setDuration(float $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDirection(?string $direction): static
    {
        $this->direction = $direction;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setCaller(?string $caller): static
    {
        $this->caller = $caller;

        return $this;
    }

    public function getCaller(): ?string
    {
        return $this->caller;
    }

    public function setCallee(?string $callee): static
    {
        $this->callee = $callee;

        return $this;
    }

    public function getCallee(): ?string
    {
        return $this->callee;
    }

    public function setOwner(?string $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setCallid(?string $callid): static
    {
        $this->callid = $callid;

        return $this;
    }

    public function getCallid(): ?string
    {
        return $this->callid;
    }

    public function setBrandId(?int $brandId): static
    {
        $this->brandId = $brandId;

        return $this;
    }

    public function getBrandId(): ?int
    {
        return $this->brandId;
    }

    public function setDisposition(?string $disposition): static
    {
        $this->disposition = $disposition;

        return $this;
    }

    public function getDisposition(): ?string
    {
        return $this->disposition;
    }

    public function setNumRecordings(int $numRecordings): static
    {
        $this->numRecordings = $numRecordings;

        return $this;
    }

    public function getNumRecordings(): ?int
    {
        return $this->numRecordings;
    }

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId(?int $id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId(): ?int
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setUser(?UserDto $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    public function setUserId(?int $id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    public function getUserId(): ?int
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
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

    public function setFriendId(?int $id): static
    {
        $value = !is_null($id)
            ? new FriendDto($id)
            : null;

        return $this->setFriend($value);
    }

    public function getFriendId(): ?int
    {
        if ($dto = $this->getFriend()) {
            return $dto->getId();
        }

        return null;
    }

    public function setExtension(?ExtensionDto $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?ExtensionDto
    {
        return $this->extension;
    }

    public function setExtensionId(?int $id): static
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setExtension($value);
    }

    public function getExtensionId(): ?int
    {
        if ($dto = $this->getExtension()) {
            return $dto->getId();
        }

        return null;
    }

    public function setKamUsersCdr(?UsersCdrDto $kamUsersCdr): static
    {
        $this->kamUsersCdr = $kamUsersCdr;

        return $this;
    }

    public function getKamUsersCdr(): ?UsersCdrDto
    {
        return $this->kamUsersCdr;
    }

    public function setKamUsersCdrId(?int $id): static
    {
        $value = !is_null($id)
            ? new UsersCdrDto($id)
            : null;

        return $this->setKamUsersCdr($value);
    }

    public function getKamUsersCdrId(): ?int
    {
        if ($dto = $this->getKamUsersCdr()) {
            return $dto->getId();
        }

        return null;
    }
}
