<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto;

/**
* UsersCdrDtoAbstract
* @codeCoverageIgnore
*/
abstract class UsersCdrDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var \DateTimeInterface|string
     */
    private $startTime = '2000-01-01 00:00:00';

    /**
     * @var \DateTimeInterface|string
     */
    private $endTime = '2000-01-01 00:00:00';

    /**
     * @var float
     */
    private $duration = 0;

    /**
     * @var string|null
     */
    private $direction;

    /**
     * @var string|null
     */
    private $caller;

    /**
     * @var string|null
     */
    private $callee;

    /**
     * @var string|null
     */
    private $diversion;

    /**
     * @var string|null
     */
    private $referee;

    /**
     * @var string|null
     */
    private $referrer;

    /**
     * @var string|null
     */
    private $callid;

    /**
     * @var string|null
     */
    private $callidHash;

    /**
     * @var string|null
     */
    private $xcallid;

    /**
     * @var bool
     */
    private $hidden = false;

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var UserDto | null
     */
    private $user;

    /**
     * @var FriendDto | null
     */
    private $friend;

    /**
     * @var ResidentialDeviceDto | null
     */
    private $residentialDevice;

    /**
     * @var RetailAccountDto | null
     */
    private $retailAccount;

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
            'hidden' => 'hidden',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'userId' => 'user',
            'friendId' => 'friend',
            'residentialDeviceId' => 'residentialDevice',
            'retailAccountId' => 'retailAccount'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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
            'hidden' => $this->getHidden(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'user' => $this->getUser(),
            'friend' => $this->getFriend(),
            'residentialDevice' => $this->getResidentialDevice(),
            'retailAccount' => $this->getRetailAccount()
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

    public function setHidden(bool $hidden): static
    {
        $this->hidden = $hidden;

        return $this;
    }

    public function getHidden(): ?bool
    {
        return $this->hidden;
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

    public function setResidentialDevice(?ResidentialDeviceDto $residentialDevice): static
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceDto
    {
        return $this->residentialDevice;
    }

    public function setResidentialDeviceId($id): static
    {
        $value = !is_null($id)
            ? new ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    public function getResidentialDeviceId()
    {
        if ($dto = $this->getResidentialDevice()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRetailAccount(?RetailAccountDto $retailAccount): static
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    public function getRetailAccount(): ?RetailAccountDto
    {
        return $this->retailAccount;
    }

    public function setRetailAccountId($id): static
    {
        $value = !is_null($id)
            ? new RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }
}
