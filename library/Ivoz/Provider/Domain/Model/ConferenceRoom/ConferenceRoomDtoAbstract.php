<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class ConferenceRoomDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $pinProtected = 0;

    /**
     * @var string
     */
    private $pinCode;

    /**
     * @var integer
     */
    private $maxMembers = 0;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;


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
            'name' => 'name',
            'pinProtected' => 'pinProtected',
            'pinCode' => 'pinCode',
            'maxMembers' => 'maxMembers',
            'id' => 'id',
            'companyId' => 'company'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'name' => $this->getName(),
            'pinProtected' => $this->getPinProtected(),
            'pinCode' => $this->getPinCode(),
            'maxMembers' => $this->getMaxMembers(),
            'id' => $this->getId(),
            'company' => $this->getCompany()
        ];
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param boolean $pinProtected
     *
     * @return static
     */
    public function setPinProtected($pinProtected = null)
    {
        $this->pinProtected = $pinProtected;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getPinProtected()
    {
        return $this->pinProtected;
    }

    /**
     * @param string $pinCode
     *
     * @return static
     */
    public function setPinCode($pinCode = null)
    {
        $this->pinCode = $pinCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getPinCode()
    {
        return $this->pinCode;
    }

    /**
     * @param integer $maxMembers
     *
     * @return static
     */
    public function setMaxMembers($maxMembers = null)
    {
        $this->maxMembers = $maxMembers;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMaxMembers()
    {
        return $this->maxMembers;
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
}
