<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class OutgoingRoutingRelCarrierDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto | null
     */
    private $outgoingRouting;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    private $carrier;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileDto[] | null
     */
    private $tpRatingProfiles = null;


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
        return [
            'id' => $this->getId(),
            'outgoingRouting' => $this->getOutgoingRouting(),
            'carrier' => $this->getCarrier(),
            'tpRatingProfiles' => $this->getTpRatingProfiles()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->outgoingRouting = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\OutgoingRouting\\OutgoingRouting', $this->getOutgoingRoutingId());
        $this->carrier = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Carrier\\Carrier', $this->getCarrierId());
        if (!is_null($this->tpRatingProfiles)) {
            $items = $this->getTpRatingProfiles();
            $this->tpRatingProfiles = [];
            foreach ($items as $item) {
                $this->tpRatingProfiles[] = $transformer->transform(
                    'Ivoz\\Cgr\\Domain\\Model\\TpRatingProfile\\TpRatingProfile',
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
        $this->tpRatingProfiles = $transformer->transform(
            'Ivoz\\Cgr\\Domain\\Model\\TpRatingProfile\\TpRatingProfile',
            $this->tpRatingProfiles
        );
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
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto $outgoingRouting
     *
     * @return static
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto $outgoingRouting = null)
    {
        $this->outgoingRouting = $outgoingRouting;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto
     */
    public function getOutgoingRouting()
    {
        return $this->outgoingRouting;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setOutgoingRoutingId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto($id)
            : null;

        return $this->setOutgoingRouting($value);
    }

    /**
     * @return integer | null
     */
    public function getOutgoingRoutingId()
    {
        if ($dto = $this->getOutgoingRouting()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierDto
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCarrierId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Carrier\CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return integer | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $tpRatingProfiles
     *
     * @return static
     */
    public function setTpRatingProfiles($tpRatingProfiles = null)
    {
        $this->tpRatingProfiles = $tpRatingProfiles;

        return $this;
    }

    /**
     * @return array
     */
    public function getTpRatingProfiles()
    {
        return $this->tpRatingProfiles;
    }
}


