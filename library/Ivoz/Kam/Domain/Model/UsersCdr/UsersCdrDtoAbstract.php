<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;

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
     * @var \DateTimeInterface|string|null
     */
    private $endTime = '2000-01-01 00:00:00';

    /**
     * @var float|null
     */
    private $duration = 0;

    /**
     * @var string|null
     */
    private $direction = null;

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
    private $diversion = null;

    /**
     * @var string|null
     */
    private $referee = null;

    /**
     * @var string|null
     */
    private $referrer = null;

    /**
     * @var string|null
     */
    private $callid = null;

    /**
     * @var string|null
     */
    private $callidHash = null;

    /**
     * @var string|null
     */
    private $xcallid = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

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
     * @param string|int|null $id
     */
    public function __construct($id = null)
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
            'endTime' => 'endTime',
            'duration' => 'duration',
            'direction' => 'direction',
            'caller' => 'caller',
            'callee' => 'callee',
            'diversion' => 'diversion',
            'referee' => 'referee',
            'referrer' => 'referrer',
            'callid' => 'callid',
            'callidHash' => 'callidHash',
            'xcallid' => 'xcallid',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'userId' => 'user',
            'friendId' => 'friend'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'startTime' => $this->getStartTime(),
            'endTime' => $this->getEndTime(),
            'duration' => $this->getDuration(),
            'direction' => $this->getDirection(),
            'caller' => $this->getCaller(),
            'callee' => $this->getCallee(),
            'diversion' => $this->getDiversion(),
            'referee' => $this->getReferee(),
            'referrer' => $this->getReferrer(),
            'callid' => $this->getCallid(),
            'callidHash' => $this->getCallidHash(),
            'xcallid' => $this->getXcallid(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'user' => $this->getUser(),
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

    public function setStartTime(\DateTimeInterface|string $startTime): static
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getStartTime(): \DateTimeInterface|string|null
    {
        return $this->startTime;
    }

    public function setEndTime(\DateTimeInterface|string $endTime): static
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getEndTime(): \DateTimeInterface|string|null
    {
        return $this->endTime;
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

    public function setDiversion(?string $diversion): static
    {
        $this->diversion = $diversion;

        return $this;
    }

    public function getDiversion(): ?string
    {
        return $this->diversion;
    }

    public function setReferee(?string $referee): static
    {
        $this->referee = $referee;

        return $this;
    }

    public function getReferee(): ?string
    {
        return $this->referee;
    }

    public function setReferrer(?string $referrer): static
    {
        $this->referrer = $referrer;

        return $this;
    }

    public function getReferrer(): ?string
    {
        return $this->referrer;
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

    public function setCallidHash(?string $callidHash): static
    {
        $this->callidHash = $callidHash;

        return $this;
    }

    public function getCallidHash(): ?string
    {
        return $this->callidHash;
    }

    public function setXcallid(?string $xcallid): static
    {
        $this->xcallid = $xcallid;

        return $this;
    }

    public function getXcallid(): ?string
    {
        return $this->xcallid;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
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

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
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

    public function setUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    public function getUserId()
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
