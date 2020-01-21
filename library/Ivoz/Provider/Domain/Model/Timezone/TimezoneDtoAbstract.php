<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TimezoneDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $tz;

    /**
     * @var string
     */
    private $comment = '';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $labelEn = '';

    /**
     * @var string
     */
    private $labelEs = '';

    /**
     * @var string
     */
    private $labelCa = '';

    /**
     * @var string
     */
    private $labelIt = '';

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $country;


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
            'tz' => 'tz',
            'comment' => 'comment',
            'id' => 'id',
            'label' => ['en','es','ca','it'],
            'countryId' => 'country'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'tz' => $this->getTz(),
            'comment' => $this->getComment(),
            'id' => $this->getId(),
            'label' => [
                'en' => $this->getLabelEn(),
                'es' => $this->getLabelEs(),
                'ca' => $this->getLabelCa(),
                'it' => $this->getLabelIt()
            ],
            'country' => $this->getCountry()
        ];
    }

    /**
     * @param string $tz
     *
     * @return static
     */
    public function setTz($tz = null)
    {
        $this->tz = $tz;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTz()
    {
        return $this->tz;
    }

    /**
     * @param string $comment
     *
     * @return static
     */
    public function setComment($comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getComment()
    {
        return $this->comment;
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
     * @param string $labelEn
     *
     * @return static
     */
    public function setLabelEn($labelEn = null)
    {
        $this->labelEn = $labelEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLabelEn()
    {
        return $this->labelEn;
    }

    /**
     * @param string $labelEs
     *
     * @return static
     */
    public function setLabelEs($labelEs = null)
    {
        $this->labelEs = $labelEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLabelEs()
    {
        return $this->labelEs;
    }

    /**
     * @param string $labelCa
     *
     * @return static
     */
    public function setLabelCa($labelCa = null)
    {
        $this->labelCa = $labelCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLabelCa()
    {
        return $this->labelCa;
    }

    /**
     * @param string $labelIt
     *
     * @return static
     */
    public function setLabelIt($labelIt = null)
    {
        $this->labelIt = $labelIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLabelIt()
    {
        return $this->labelIt;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $country
     *
     * @return static
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getCountryId()
    {
        if ($dto = $this->getCountry()) {
            return $dto->getId();
        }

        return null;
    }
}
