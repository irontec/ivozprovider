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
     * @var \DateTimeInterface
     */
    private $startTime = '2000-01-01 00:00:00';

    /**
     * @var \DateTimeInterface
     */
    private $endTime = '2000-01-01 00:00:00';

    /**
     * @var float
     */
    private $duration = 0;

    /**
     * @var string | null
     */
    private $direction;

    /**
     * @var string | null
     */
    private $caller;

    /**
     * @var string | null
     */
    private $callee;

    /**
     * @var string | null
     */
    private $diversion;

    /**
     * @var string | null
     */
    private $referee;

    /**
     * @var string | null
     */
    private $referrer;

    /**
     * @var string | null
     */
    private $callid;

    /**
     * @var string | null
     */
    private $callidHash;

    /**
     * @var string | null
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

    /**
     * @param \DateTimeInterface $startTime | null
     *
     * @return static
     */
    public function setStartTime($startTime = null): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param \DateTimeInterface $endTime | null
     *
     * @return static
     */
    public function setEndTime($endTime = null): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param float $duration | null
     *
     * @return static
     */
    public function setDuration(?float $duration = null): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getDuration(): ?float
    {
        return $this->duration;
    }

    /**
     * @param string $direction | null
     *
     * @return static
     */
    public function setDirection(?string $direction = null): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirection(): ?string
    {
        return $this->direction;
    }

    /**
     * @param string $caller | null
     *
     * @return static
     */
    public function setCaller(?string $caller = null): self
    {
        $this->caller = $caller;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCaller(): ?string
    {
        return $this->caller;
    }

    /**
     * @param string $callee | null
     *
     * @return static
     */
    public function setCallee(?string $callee = null): self
    {
        $this->callee = $callee;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallee(): ?string
    {
        return $this->callee;
    }

    /**
     * @param string $diversion | null
     *
     * @return static
     */
    public function setDiversion(?string $diversion = null): self
    {
        $this->diversion = $diversion;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDiversion(): ?string
    {
        return $this->diversion;
    }

    /**
     * @param string $referee | null
     *
     * @return static
     */
    public function setReferee(?string $referee = null): self
    {
        $this->referee = $referee;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getReferee(): ?string
    {
        return $this->referee;
    }

    /**
     * @param string $referrer | null
     *
     * @return static
     */
    public function setReferrer(?string $referrer = null): self
    {
        $this->referrer = $referrer;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getReferrer(): ?string
    {
        return $this->referrer;
    }

    /**
     * @param string $callid | null
     *
     * @return static
     */
    public function setCallid(?string $callid = null): self
    {
        $this->callid = $callid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallid(): ?string
    {
        return $this->callid;
    }

    /**
     * @param string $callidHash | null
     *
     * @return static
     */
    public function setCallidHash(?string $callidHash = null): self
    {
        $this->callidHash = $callidHash;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallidHash(): ?string
    {
        return $this->callidHash;
    }

    /**
     * @param string $xcallid | null
     *
     * @return static
     */
    public function setXcallid(?string $xcallid = null): self
    {
        $this->xcallid = $xcallid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getXcallid(): ?string
    {
        return $this->xcallid;
    }

    /**
     * @param bool $hidden | null
     *
     * @return static
     */
    public function setHidden(?bool $hidden = null): self
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getHidden(): ?bool
    {
        return $this->hidden;
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
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setUser(?UserDto $user = null): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    /**
     * @return static
     */
    public function setUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getUserId()
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
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

    /**
     * @param ResidentialDeviceDto | null
     *
     * @return static
     */
    public function setResidentialDevice(?ResidentialDeviceDto $residentialDevice = null): self
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * @return ResidentialDeviceDto | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceDto
    {
        return $this->residentialDevice;
    }

    /**
     * @return static
     */
    public function setResidentialDeviceId($id): self
    {
        $value = !is_null($id)
            ? new ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    /**
     * @return mixed | null
     */
    public function getResidentialDeviceId()
    {
        if ($dto = $this->getResidentialDevice()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RetailAccountDto | null
     *
     * @return static
     */
    public function setRetailAccount(?RetailAccountDto $retailAccount = null): self
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * @return RetailAccountDto | null
     */
    public function getRetailAccount(): ?RetailAccountDto
    {
        return $this->retailAccount;
    }

    /**
     * @return static
     */
    public function setRetailAccountId($id): self
    {
        $value = !is_null($id)
            ? new RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    /**
     * @return mixed | null
     */
    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }

}
