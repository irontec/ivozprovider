<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class UsersCdrDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var \DateTime
     */
    private $startTime = '2000-01-01 00:00:00';

    /**
     * @var \DateTime
     */
    private $endTime = '2000-01-01 00:00:00';

    /**
     * @var float
     */
    private $duration = '0.000';

    /**
     * @var string
     */
    private $direction;

    /**
     * @var string
     */
    private $caller;

    /**
     * @var string
     */
    private $callee;

    /**
     * @var string
     */
    private $diversion;

    /**
     * @var string
     */
    private $referee;

    /**
     * @var string
     */
    private $referrer;

    /**
     * @var string
     */
    private $callid;

    /**
     * @var string
     */
    private $callidHash;

    /**
     * @var string
     */
    private $xcallid;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Friend\FriendDto | null
     */
    private $friend;

    /**
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto | null
     */
    private $residentialDevice;

    /**
     * @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto | null
     */
    private $retailAccount;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
        return [
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
            'friend' => $this->getFriend(),
            'residentialDevice' => $this->getResidentialDevice(),
            'retailAccount' => $this->getRetailAccount()
        ];
    }

    /**
     * @param \DateTime $startTime
     *
     * @return static
     */
    public function setStartTime($startTime = null)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param \DateTime $endTime
     *
     * @return static
     */
    public function setEndTime($endTime = null)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param float $duration
     *
     * @return static
     */
    public function setDuration($duration = null)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param string $direction
     *
     * @return static
     */
    public function setDirection($direction = null)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param string $caller
     *
     * @return static
     */
    public function setCaller($caller = null)
    {
        $this->caller = $caller;

        return $this;
    }

    /**
     * @return string
     */
    public function getCaller()
    {
        return $this->caller;
    }

    /**
     * @param string $callee
     *
     * @return static
     */
    public function setCallee($callee = null)
    {
        $this->callee = $callee;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallee()
    {
        return $this->callee;
    }

    /**
     * @param string $diversion
     *
     * @return static
     */
    public function setDiversion($diversion = null)
    {
        $this->diversion = $diversion;

        return $this;
    }

    /**
     * @return string
     */
    public function getDiversion()
    {
        return $this->diversion;
    }

    /**
     * @param string $referee
     *
     * @return static
     */
    public function setReferee($referee = null)
    {
        $this->referee = $referee;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferee()
    {
        return $this->referee;
    }

    /**
     * @param string $referrer
     *
     * @return static
     */
    public function setReferrer($referrer = null)
    {
        $this->referrer = $referrer;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * @param string $callid
     *
     * @return static
     */
    public function setCallid($callid = null)
    {
        $this->callid = $callid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * @param string $callidHash
     *
     * @return static
     */
    public function setCallidHash($callidHash = null)
    {
        $this->callidHash = $callidHash;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallidHash()
    {
        return $this->callidHash;
    }

    /**
     * @param string $xcallid
     *
     * @return static
     */
    public function setXcallid($xcallid = null)
    {
        $this->xcallid = $xcallid;

        return $this;
    }

    /**
     * @return string
     */
    public function getXcallid()
    {
        return $this->xcallid;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return integer | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $user
     *
     * @return static
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserDto $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setUser($value);
    }

    /**
     * @return integer | null
     */
    public function getUserId()
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendDto $friend
     *
     * @return static
     */
    public function setFriend(\Ivoz\Provider\Domain\Model\Friend\FriendDto $friend = null)
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendDto
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFriendId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Friend\FriendDto($id)
            : null;

        return $this->setFriend($value);
    }

    /**
     * @return integer | null
     */
    public function getFriendId()
    {
        if ($dto = $this->getFriend()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto $residentialDevice
     *
     * @return static
     */
    public function setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto $residentialDevice = null)
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto
     */
    public function getResidentialDevice()
    {
        return $this->residentialDevice;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setResidentialDeviceId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    /**
     * @return integer | null
     */
    public function getResidentialDeviceId()
    {
        if ($dto = $this->getResidentialDevice()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto $retailAccount
     *
     * @return static
     */
    public function setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto $retailAccount = null)
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto
     */
    public function getRetailAccount()
    {
        return $this->retailAccount;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRetailAccountId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    /**
     * @return integer | null
     */
    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }
}
