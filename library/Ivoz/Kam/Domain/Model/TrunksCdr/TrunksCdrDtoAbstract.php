<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TrunksCdrDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var \DateTime | string
     */
    private $startTime = '2000-01-01 00:00:00';

    /**
     * @var \DateTime | string
     */
    private $endTime = '2000-01-01 00:00:00';

    /**
     * @var float
     */
    private $duration = 0.0;

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
     * @var string
     */
    private $diversion;

    /**
     * @var boolean
     */
    private $bounced;

    /**
     * @var boolean
     */
    private $parsed = false;

    /**
     * @var \DateTime | string
     */
    private $parserScheduledAt = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $direction;

    /**
     * @var string
     */
    private $cgrid;

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
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    private $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto | null
     */
    private $retailAccount;

    /**
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto | null
     */
    private $residentialDevice;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Friend\FriendDto | null
     */
    private $friend;

    /**
     * @var \Ivoz\Provider\Domain\Model\Fax\FaxDto | null
     */
    private $fax;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiDto | null
     */
    private $ddi;


    use DtoNormalizer;

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
            'caller' => 'caller',
            'callee' => 'callee',
            'callid' => 'callid',
            'callidHash' => 'callidHash',
            'xcallid' => 'xcallid',
            'diversion' => 'diversion',
            'bounced' => 'bounced',
            'parsed' => 'parsed',
            'parserScheduledAt' => 'parserScheduledAt',
            'direction' => 'direction',
            'cgrid' => 'cgrid',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'carrierId' => 'carrier',
            'retailAccountId' => 'retailAccount',
            'residentialDeviceId' => 'residentialDevice',
            'userId' => 'user',
            'friendId' => 'friend',
            'faxId' => 'fax',
            'ddiId' => 'ddi'
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
            'caller' => $this->getCaller(),
            'callee' => $this->getCallee(),
            'callid' => $this->getCallid(),
            'callidHash' => $this->getCallidHash(),
            'xcallid' => $this->getXcallid(),
            'diversion' => $this->getDiversion(),
            'bounced' => $this->getBounced(),
            'parsed' => $this->getParsed(),
            'parserScheduledAt' => $this->getParserScheduledAt(),
            'direction' => $this->getDirection(),
            'cgrid' => $this->getCgrid(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier(),
            'retailAccount' => $this->getRetailAccount(),
            'residentialDevice' => $this->getResidentialDevice(),
            'user' => $this->getUser(),
            'friend' => $this->getFriend(),
            'fax' => $this->getFax(),
            'ddi' => $this->getDdi()
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
     * @return \DateTime | null
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
     * @return \DateTime | null
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
     * @return float | null
     */
    public function getDuration()
    {
        return $this->duration;
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
     * @return string | null
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
     * @return string | null
     */
    public function getCallee()
    {
        return $this->callee;
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
     * @return string | null
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
     * @return string | null
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
     * @return string | null
     */
    public function getXcallid()
    {
        return $this->xcallid;
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
     * @return string | null
     */
    public function getDiversion()
    {
        return $this->diversion;
    }

    /**
     * @param boolean $bounced
     *
     * @return static
     */
    public function setBounced($bounced = null)
    {
        $this->bounced = $bounced;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getBounced()
    {
        return $this->bounced;
    }

    /**
     * @param boolean $parsed
     *
     * @return static
     */
    public function setParsed($parsed = null)
    {
        $this->parsed = $parsed;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getParsed()
    {
        return $this->parsed;
    }

    /**
     * @param \DateTime $parserScheduledAt
     *
     * @return static
     */
    public function setParserScheduledAt($parserScheduledAt = null)
    {
        $this->parserScheduledAt = $parserScheduledAt;

        return $this;
    }

    /**
     * @return \DateTime | null
     */
    public function getParserScheduledAt()
    {
        return $this->parserScheduledAt;
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
     * @return string | null
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param string $cgrid
     *
     * @return static
     */
    public function setCgrid($cgrid = null)
    {
        $this->cgrid = $cgrid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCgrid()
    {
        return $this->cgrid;
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
     * @return integer | null
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
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed | null $id
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
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCarrierId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Carrier\CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return mixed | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
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
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto | null
     */
    public function getRetailAccount()
    {
        return $this->retailAccount;
    }

    /**
     * @param mixed | null $id
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
     * @return mixed | null
     */
    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
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
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto | null
     */
    public function getResidentialDevice()
    {
        return $this->residentialDevice;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendDto | null
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * @param mixed | null $id
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
     * @param \Ivoz\Provider\Domain\Model\Fax\FaxDto $fax
     *
     * @return static
     */
    public function setFax(\Ivoz\Provider\Domain\Model\Fax\FaxDto $fax = null)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxDto | null
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setFaxId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Fax\FaxDto($id)
            : null;

        return $this->setFax($value);
    }

    /**
     * @return mixed | null
     */
    public function getFaxId()
    {
        if ($dto = $this->getFax()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiDto $ddi
     *
     * @return static
     */
    public function setDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiDto $ddi = null)
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiDto | null
     */
    public function getDdi()
    {
        return $this->ddi;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setDdiId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Ddi\DdiDto($id)
            : null;

        return $this->setDdi($value);
    }

    /**
     * @return mixed | null
     */
    public function getDdiId()
    {
        if ($dto = $this->getDdi()) {
            return $dto->getId();
        }

        return null;
    }
}
