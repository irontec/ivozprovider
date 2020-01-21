<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class RoutingPatternDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nameEn;

    /**
     * @var string
     */
    private $nameEs;

    /**
     * @var string
     */
    private $nameCa;

    /**
     * @var string
     */
    private $nameIt;

    /**
     * @var string
     */
    private $descriptionEn;

    /**
     * @var string
     */
    private $descriptionEs;

    /**
     * @var string
     */
    private $descriptionCa;

    /**
     * @var string
     */
    private $descriptionIt;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto[] | null
     */
    private $outgoingRoutings = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto[] | null
     */
    private $relPatternGroups = null;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto[] | null
     */
    private $lcrRules = null;


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
            'prefix' => 'prefix',
            'id' => 'id',
            'name' => ['en','es','ca','it'],
            'description' => ['en','es','ca','it'],
            'brandId' => 'brand'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'prefix' => $this->getPrefix(),
            'id' => $this->getId(),
            'name' => [
                'en' => $this->getNameEn(),
                'es' => $this->getNameEs(),
                'ca' => $this->getNameCa(),
                'it' => $this->getNameIt()
            ],
            'description' => [
                'en' => $this->getDescriptionEn(),
                'es' => $this->getDescriptionEs(),
                'ca' => $this->getDescriptionCa(),
                'it' => $this->getDescriptionIt()
            ],
            'brand' => $this->getBrand(),
            'outgoingRoutings' => $this->getOutgoingRoutings(),
            'relPatternGroups' => $this->getRelPatternGroups(),
            'lcrRules' => $this->getLcrRules()
        ];
    }

    /**
     * @param string $prefix
     *
     * @return static
     */
    public function setPrefix($prefix = null)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPrefix()
    {
        return $this->prefix;
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
     * @param string $nameEn
     *
     * @return static
     */
    public function setNameEn($nameEn = null)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs
     *
     * @return static
     */
    public function setNameEs($nameEs = null)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }

    /**
     * @param string $nameCa
     *
     * @return static
     */
    public function setNameCa($nameCa = null)
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameCa()
    {
        return $this->nameCa;
    }

    /**
     * @param string $nameIt
     *
     * @return static
     */
    public function setNameIt($nameIt = null)
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameIt()
    {
        return $this->nameIt;
    }

    /**
     * @param string $descriptionEn
     *
     * @return static
     */
    public function setDescriptionEn($descriptionEn = null)
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * @param string $descriptionEs
     *
     * @return static
     */
    public function setDescriptionEs($descriptionEs = null)
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEs()
    {
        return $this->descriptionEs;
    }

    /**
     * @param string $descriptionCa
     *
     * @return static
     */
    public function setDescriptionCa($descriptionCa = null)
    {
        $this->descriptionCa = $descriptionCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionCa()
    {
        return $this->descriptionCa;
    }

    /**
     * @param string $descriptionIt
     *
     * @return static
     */
    public function setDescriptionIt($descriptionIt = null)
    {
        $this->descriptionIt = $descriptionIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionIt()
    {
        return $this->descriptionIt;
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
     * @param array $outgoingRoutings
     *
     * @return static
     */
    public function setOutgoingRoutings($outgoingRoutings = null)
    {
        $this->outgoingRoutings = $outgoingRoutings;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getOutgoingRoutings()
    {
        return $this->outgoingRoutings;
    }

    /**
     * @param array $relPatternGroups
     *
     * @return static
     */
    public function setRelPatternGroups($relPatternGroups = null)
    {
        $this->relPatternGroups = $relPatternGroups;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getRelPatternGroups()
    {
        return $this->relPatternGroups;
    }

    /**
     * @param array $lcrRules
     *
     * @return static
     */
    public function setLcrRules($lcrRules = null)
    {
        $this->lcrRules = $lcrRules;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getLcrRules()
    {
        return $this->lcrRules;
    }
}
