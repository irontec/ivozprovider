<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class CompanyRelRoutingTagDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto | null
     */
    private $routingTag;


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
            'id' => 'id',
            'companyId' => 'company',
            'routingTagId' => 'routingTag'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'routingTag' => $this->getRoutingTag()
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
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto $routingTag
     *
     * @return static
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto $routingTag = null)
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto | null
     */
    public function getRoutingTag()
    {
        return $this->routingTag;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setRoutingTagId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto($id)
            : null;

        return $this->setRoutingTag($value);
    }

    /**
     * @return mixed | null
     */
    public function getRoutingTagId()
    {
        if ($dto = $this->getRoutingTag()) {
            return $dto->getId();
        }

        return null;
    }
}
