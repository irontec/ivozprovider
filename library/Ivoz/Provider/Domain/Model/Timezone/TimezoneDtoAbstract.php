<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

/**
* TimezoneDtoAbstract
* @codeCoverageIgnore
*/
abstract class TimezoneDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $tz;

    /**
     * @var string | null
     */
    private $comment = '';

    /**
     * @var int
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
     * @var CountryDto | null
     */
    private $country;

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
            'label' => [
                'en',
                'es',
                'ca',
                'it',
            ],
            'countryId' => 'country'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'tz' => $this->getTz(),
            'comment' => $this->getComment(),
            'id' => $this->getId(),
            'label' => [
                'en' => $this->getLabelEn(),
                'es' => $this->getLabelEs(),
                'ca' => $this->getLabelCa(),
                'it' => $this->getLabelIt(),
            ],
            'country' => $this->getCountry()
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
     * @param string $tz | null
     *
     * @return static
     */
    public function setTz(?string $tz = null): self
    {
        $this->tz = $tz;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTz(): ?string
    {
        return $this->tz;
    }

    /**
     * @param string $comment | null
     *
     * @return static
     */
    public function setComment(?string $comment = null): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getComment(): ?string
    {
        return $this->comment;
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
     * @param string $labelEn | null
     *
     * @return static
     */
    public function setLabelEn(?string $labelEn = null): self
    {
        $this->labelEn = $labelEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLabelEn(): ?string
    {
        return $this->labelEn;
    }

    /**
     * @param string $labelEs | null
     *
     * @return static
     */
    public function setLabelEs(?string $labelEs = null): self
    {
        $this->labelEs = $labelEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLabelEs(): ?string
    {
        return $this->labelEs;
    }

    /**
     * @param string $labelCa | null
     *
     * @return static
     */
    public function setLabelCa(?string $labelCa = null): self
    {
        $this->labelCa = $labelCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLabelCa(): ?string
    {
        return $this->labelCa;
    }

    /**
     * @param string $labelIt | null
     *
     * @return static
     */
    public function setLabelIt(?string $labelIt = null): self
    {
        $this->labelIt = $labelIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLabelIt(): ?string
    {
        return $this->labelIt;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setCountry(?CountryDto $country = null): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getCountry(): ?CountryDto
    {
        return $this->country;
    }

    /**
     * @return static
     */
    public function setCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
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
