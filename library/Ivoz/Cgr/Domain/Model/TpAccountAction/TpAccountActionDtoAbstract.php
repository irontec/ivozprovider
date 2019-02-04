<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpAccountActionDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string
     */
    private $loadid = 'DATABASE';

    /**
     * @var string
     */
    private $tenant;

    /**
     * @var string
     */
    private $account;

    /**
     * @var string
     */
    private $actionPlanTag;

    /**
     * @var string
     */
    private $actionTriggersTag;

    /**
     * @var boolean
     */
    private $allowNegative = 0;

    /**
     * @var boolean
     */
    private $disabled = 0;

    /**
     * @var \DateTime
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    private $carrier;


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
            'tpid' => 'tpid',
            'loadid' => 'loadid',
            'tenant' => 'tenant',
            'account' => 'account',
            'actionPlanTag' => 'actionPlanTag',
            'actionTriggersTag' => 'actionTriggersTag',
            'allowNegative' => 'allowNegative',
            'disabled' => 'disabled',
            'createdAt' => 'createdAt',
            'id' => 'id',
            'companyId' => 'company',
            'carrierId' => 'carrier'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'tpid' => $this->getTpid(),
            'loadid' => $this->getLoadid(),
            'tenant' => $this->getTenant(),
            'account' => $this->getAccount(),
            'actionPlanTag' => $this->getActionPlanTag(),
            'actionTriggersTag' => $this->getActionTriggersTag(),
            'allowNegative' => $this->getAllowNegative(),
            'disabled' => $this->getDisabled(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier()
        ];
    }

    /**
     * @param string $tpid
     *
     * @return static
     */
    public function setTpid($tpid = null)
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @param string $loadid
     *
     * @return static
     */
    public function setLoadid($loadid = null)
    {
        $this->loadid = $loadid;

        return $this;
    }

    /**
     * @return string
     */
    public function getLoadid()
    {
        return $this->loadid;
    }

    /**
     * @param string $tenant
     *
     * @return static
     */
    public function setTenant($tenant = null)
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * @return string
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @param string $account
     *
     * @return static
     */
    public function setAccount($account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param string $actionPlanTag
     *
     * @return static
     */
    public function setActionPlanTag($actionPlanTag = null)
    {
        $this->actionPlanTag = $actionPlanTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getActionPlanTag()
    {
        return $this->actionPlanTag;
    }

    /**
     * @param string $actionTriggersTag
     *
     * @return static
     */
    public function setActionTriggersTag($actionTriggersTag = null)
    {
        $this->actionTriggersTag = $actionTriggersTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getActionTriggersTag()
    {
        return $this->actionTriggersTag;
    }

    /**
     * @param boolean $allowNegative
     *
     * @return static
     */
    public function setAllowNegative($allowNegative = null)
    {
        $this->allowNegative = $allowNegative;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getAllowNegative()
    {
        return $this->allowNegative;
    }

    /**
     * @param boolean $disabled
     *
     * @return static
     */
    public function setDisabled($disabled = null)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierDto
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param integer $id | null
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
     * @return integer | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }
}
