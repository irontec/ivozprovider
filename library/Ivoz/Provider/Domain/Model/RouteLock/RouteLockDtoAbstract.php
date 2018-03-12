<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class RouteLockDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var boolean
     */
    private $open = '0';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto[] | null
     */
    private $psEndpoints = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiDto[] | null
     */
    private $ddis = null;


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
            'description' => 'description',
            'open' => 'open',
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
            'description' => $this->getDescription(),
            'open' => $this->getOpen(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'psEndpoints' => $this->getPsEndpoints(),
            'ddis' => $this->getDdis()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        if (!is_null($this->psEndpoints)) {
            $items = $this->getPsEndpoints();
            $this->psEndpoints = [];
            foreach ($items as $item) {
                $this->psEndpoints[] = $transformer->transform(
                    'Ivoz\\Ast\\Domain\\Model\\PsEndpoint\\PsEndpoint',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->ddis)) {
            $items = $this->getDdis();
            $this->ddis = [];
            foreach ($items as $item) {
                $this->ddis[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\Ddi\\Ddi',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->psEndpoints = $transformer->transform(
            'Ivoz\\Ast\\Domain\\Model\\PsEndpoint\\PsEndpoint',
            $this->psEndpoints
        );
        $this->ddis = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\Ddi\\Ddi',
            $this->ddis
        );
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
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param boolean $open
     *
     * @return static
     */
    public function setOpen($open = null)
    {
        $this->open = $open;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getOpen()
    {
        return $this->open;
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
     * @param array $psEndpoints
     *
     * @return static
     */
    public function setPsEndpoints($psEndpoints = null)
    {
        $this->psEndpoints = $psEndpoints;

        return $this;
    }

    /**
     * @return array
     */
    public function getPsEndpoints()
    {
        return $this->psEndpoints;
    }

    /**
     * @param array $ddis
     *
     * @return static
     */
    public function setDdis($ddis = null)
    {
        $this->ddis = $ddis;

        return $this;
    }

    /**
     * @return array
     */
    public function getDdis()
    {
        return $this->ddis;
    }
}


