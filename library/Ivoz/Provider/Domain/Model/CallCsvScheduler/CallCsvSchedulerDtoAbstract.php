<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Fax\FaxDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto;

/**
* CallCsvSchedulerDtoAbstract
* @codeCoverageIgnore
*/
abstract class CallCsvSchedulerDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $unit = 'month';

    /**
     * @var int
     */
    private $frequency;

    /**
     * @var string | null
     */
    private $callDirection = 'outbound';

    /**
     * @var string
     */
    private $email;

    /**
     * @var \DateTimeInterface | null
     */
    private $lastExecution;

    /**
     * @var string | null
     */
    private $lastExecutionError;

    /**
     * @var \DateTimeInterface | null
     */
    private $nextExecution;

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
     * @var NotificationTemplateDto | null
     */
    private $callCsvNotificationTemplate;

    /**
     * @var DdiDto | null
     */
    private $ddi;

    /**
     * @var CarrierDto | null
     */
    private $carrier;

    /**
     * @var RetailAccountDto | null
     */
    private $retailAccount;

    /**
     * @var ResidentialDeviceDto | null
     */
    private $residentialDevice;

    /**
     * @var UserDto | null
     */
    private $user;

    /**
     * @var FaxDto | null
     */
    private $fax;

    /**
     * @var FriendDto | null
     */
    private $friend;

    /**
     * @var DdiProviderDto | null
     */
    private $ddiProvider;

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
            'unit' => 'unit',
            'frequency' => 'frequency',
            'callDirection' => 'callDirection',
            'email' => 'email',
            'lastExecution' => 'lastExecution',
            'lastExecutionError' => 'lastExecutionError',
            'nextExecution' => 'nextExecution',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'callCsvNotificationTemplateId' => 'callCsvNotificationTemplate',
            'ddiId' => 'ddi',
            'carrierId' => 'carrier',
            'retailAccountId' => 'retailAccount',
            'residentialDeviceId' => 'residentialDevice',
            'userId' => 'user',
            'faxId' => 'fax',
            'friendId' => 'friend',
            'ddiProviderId' => 'ddiProvider'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'unit' => $this->getUnit(),
            'frequency' => $this->getFrequency(),
            'callDirection' => $this->getCallDirection(),
            'email' => $this->getEmail(),
            'lastExecution' => $this->getLastExecution(),
            'lastExecutionError' => $this->getLastExecutionError(),
            'nextExecution' => $this->getNextExecution(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'callCsvNotificationTemplate' => $this->getCallCsvNotificationTemplate(),
            'ddi' => $this->getDdi(),
            'carrier' => $this->getCarrier(),
            'retailAccount' => $this->getRetailAccount(),
            'residentialDevice' => $this->getResidentialDevice(),
            'user' => $this->getUser(),
            'fax' => $this->getFax(),
            'friend' => $this->getFriend(),
            'ddiProvider' => $this->getDdiProvider()
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
     * @param string $unit | null
     *
     * @return static
     */
    public function setUnit(?string $unit = null): self
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }

    /**
     * @param int $frequency | null
     *
     * @return static
     */
    public function setFrequency(?int $frequency = null): self
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getFrequency(): ?int
    {
        return $this->frequency;
    }

    /**
     * @param string $callDirection | null
     *
     * @return static
     */
    public function setCallDirection(?string $callDirection = null): self
    {
        $this->callDirection = $callDirection;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallDirection(): ?string
    {
        return $this->callDirection;
    }

    /**
     * @param string $email | null
     *
     * @return static
     */
    public function setEmail(?string $email = null): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param \DateTimeInterface $lastExecution | null
     *
     * @return static
     */
    public function setLastExecution($lastExecution = null): self
    {
        $this->lastExecution = $lastExecution;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getLastExecution()
    {
        return $this->lastExecution;
    }

    /**
     * @param string $lastExecutionError | null
     *
     * @return static
     */
    public function setLastExecutionError(?string $lastExecutionError = null): self
    {
        $this->lastExecutionError = $lastExecutionError;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLastExecutionError(): ?string
    {
        return $this->lastExecutionError;
    }

    /**
     * @param \DateTimeInterface $nextExecution | null
     *
     * @return static
     */
    public function setNextExecution($nextExecution = null): self
    {
        $this->nextExecution = $nextExecution;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getNextExecution()
    {
        return $this->nextExecution;
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
     * @param NotificationTemplateDto | null
     *
     * @return static
     */
    public function setCallCsvNotificationTemplate(?NotificationTemplateDto $callCsvNotificationTemplate = null): self
    {
        $this->callCsvNotificationTemplate = $callCsvNotificationTemplate;

        return $this;
    }

    /**
     * @return NotificationTemplateDto | null
     */
    public function getCallCsvNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->callCsvNotificationTemplate;
    }

    /**
     * @return static
     */
    public function setCallCsvNotificationTemplateId($id): self
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setCallCsvNotificationTemplate($value);
    }

    /**
     * @return mixed | null
     */
    public function getCallCsvNotificationTemplateId()
    {
        if ($dto = $this->getCallCsvNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DdiDto | null
     *
     * @return static
     */
    public function setDdi(?DdiDto $ddi = null): self
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * @return DdiDto | null
     */
    public function getDdi(): ?DdiDto
    {
        return $this->ddi;
    }

    /**
     * @return static
     */
    public function setDdiId($id): self
    {
        $value = !is_null($id)
            ? new DdiDto($id)
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

    /**
     * @param CarrierDto | null
     *
     * @return static
     */
    public function setCarrier(?CarrierDto $carrier = null): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return CarrierDto | null
     */
    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    /**
     * @return static
     */
    public function setCarrierId($id): self
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
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
     * @param FaxDto | null
     *
     * @return static
     */
    public function setFax(?FaxDto $fax = null): self
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * @return FaxDto | null
     */
    public function getFax(): ?FaxDto
    {
        return $this->fax;
    }

    /**
     * @return static
     */
    public function setFaxId($id): self
    {
        $value = !is_null($id)
            ? new FaxDto($id)
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
     * @param DdiProviderDto | null
     *
     * @return static
     */
    public function setDdiProvider(?DdiProviderDto $ddiProvider = null): self
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * @return DdiProviderDto | null
     */
    public function getDdiProvider(): ?DdiProviderDto
    {
        return $this->ddiProvider;
    }

    /**
     * @return static
     */
    public function setDdiProviderId($id): self
    {
        $value = !is_null($id)
            ? new DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    /**
     * @return mixed | null
     */
    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }

}
