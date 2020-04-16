<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class PickUpGroupDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserDto[] | null
     */
    private $relUsers = null;


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
            'name' => 'name',
            'id' => 'id',
            'companyId' => 'company'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'relUsers' => $this->getRelUsers()
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
     * @return string | null
     */
    public function getName()
    {
        return $this->name;
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
     * @param array $relUsers
     *
     * @return static
     */
    public function setRelUsers($relUsers = null)
    {
        $this->relUsers = $relUsers;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getRelUsers()
    {
        return $this->relUsers;
    }
}
