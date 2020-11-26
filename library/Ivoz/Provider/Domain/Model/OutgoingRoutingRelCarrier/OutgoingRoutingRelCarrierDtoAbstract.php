<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileDto;

/**
* OutgoingRoutingRelCarrierDtoAbstract
* @codeCoverageIgnore
*/
abstract class OutgoingRoutingRelCarrierDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var OutgoingRoutingDto | null
     */
    private $outgoingRouting;

    /**
     * @var CarrierDto | null
     */
    private $carrier;

    /**
     * @var TpRatingProfileDto[] | null
     */
    private $tpRatingProfiles;

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
            'outgoingRoutingId' => 'outgoingRouting',
            'carrierId' => 'carrier'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'id' => $this->getId(),
            'outgoingRouting' => $this->getOutgoingRouting(),
            'carrier' => $this->getCarrier(),
            'tpRatingProfiles' => $this->getTpRatingProfiles()
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
     * @param OutgoingRoutingDto | null
     *
     * @return static
     */
    public function setOutgoingRouting(?OutgoingRoutingDto $outgoingRouting = null): self
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * @return OutgoingRoutingDto | null
     */
    public function getOutgoingRouting(): ?OutgoingRoutingDto
    {
        return $this->outgoingRouting;
    }

    /**
     * @return static
     */
    public function setOutgoingRoutingId($id): self
    {
        $value = !is_null($id)
            ? new OutgoingRoutingDto($id)
            : null;

        return $this->setOutgoingRouting($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingRoutingId()
    {
        if ($dto = $this->getOutgoingRouting()) {
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
     * @param TpRatingProfileDto[] | null
     *
     * @return static
     */
    public function setTpRatingProfiles(?array $tpRatingProfiles = null): self
    {
        $this->tpRatingProfiles = $tpRatingProfiles;

        return $this;
    }

    /**
     * @return TpRatingProfileDto[] | null
     */
    public function getTpRatingProfiles(): ?array
    {
        return $this->tpRatingProfiles;
    }

}
