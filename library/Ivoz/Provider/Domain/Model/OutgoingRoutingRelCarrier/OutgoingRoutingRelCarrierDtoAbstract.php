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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setOutgoingRouting(?OutgoingRoutingDto $outgoingRouting): static
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    public function getOutgoingRouting(): ?OutgoingRoutingDto
    {
        return $this->outgoingRouting;
    }

    public function setOutgoingRoutingId($id): static
    {
        $value = !is_null($id)
            ? new OutgoingRoutingDto($id)
            : null;

        return $this->setOutgoingRouting($value);
    }

    public function getOutgoingRoutingId()
    {
        if ($dto = $this->getOutgoingRouting()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCarrier(?CarrierDto $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    public function setCarrierId($id): static
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTpRatingProfiles(?array $tpRatingProfiles): static
    {
        $this->tpRatingProfiles = $tpRatingProfiles;

        return $this;
    }

    public function getTpRatingProfiles(): ?array
    {
        return $this->tpRatingProfiles;
    }

}
