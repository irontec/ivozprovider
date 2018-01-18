<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TpAccountActionDTO implements DataTransferObjectInterface
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
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @return array
     */
    public function __toArray()
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
            'companyId' => $this->getCompanyId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $tpid
     *
     * @return TpAccountActionDTO
     */
    public function setTpid($tpid)
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
     * @return TpAccountActionDTO
     */
    public function setLoadid($loadid)
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
     * @return TpAccountActionDTO
     */
    public function setTenant($tenant)
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
     * @return TpAccountActionDTO
     */
    public function setAccount($account)
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
     * @return TpAccountActionDTO
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
     * @return TpAccountActionDTO
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
     * @return TpAccountActionDTO
     */
    public function setAllowNegative($allowNegative)
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
     * @return TpAccountActionDTO
     */
    public function setDisabled($disabled)
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
     * @return TpAccountActionDTO
     */
    public function setCreatedAt($createdAt)
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
     * @return TpAccountActionDTO
     */
    public function setId($id)
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
     * @param integer $companyId
     *
     * @return TpAccountActionDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }
}


