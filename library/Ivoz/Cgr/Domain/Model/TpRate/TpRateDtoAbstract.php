<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpRateDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string
     */
    private $tag;

    /**
     * @var string
     */
    private $connectFee;

    /**
     * @var string
     */
    private $rateCost;

    /**
     * @var string
     */
    private $rateUnit = '60s';

    /**
     * @var string
     */
    private $rateIncrement;

    /**
     * @var string
     */
    private $groupIntervalStart = '0s';

    /**
     * @var \DateTime
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Cgr\Domain\Model\Rate\RateDto | null
     */
    private $rate;


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
            'tpid' => 'tpid',
            'tag' => 'tag',
            'connectFee' => 'connectFee',
            'rateCost' => 'rateCost',
            'rateUnit' => 'rateUnit',
            'rateIncrement' => 'rateIncrement',
            'groupIntervalStart' => 'groupIntervalStart',
            'createdAt' => 'createdAt',
            'id' => 'id',
            'rateId' => 'rate'
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'tpid' => $this->getTpid(),
            'tag' => $this->getTag(),
            'connectFee' => $this->getConnectFee(),
            'rateCost' => $this->getRateCost(),
            'rateUnit' => $this->getRateUnit(),
            'rateIncrement' => $this->getRateIncrement(),
            'groupIntervalStart' => $this->getGroupIntervalStart(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'rate' => $this->getRate()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->rate = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\Rate\\Rate', $this->getRateId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $tpid
     *
     * @return static
     */
    public function setTpid($tpid = null)
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @param string $tag
     *
     * @return static
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $connectFee
     *
     * @return static
     */
    public function setConnectFee($connectFee = null)
    {
        $this->connectFee = $connectFee;

        return $this;
    }

    /**
     * @return string
     */
    public function getConnectFee()
    {
        return $this->connectFee;
    }

    /**
     * @param string $rateCost
     *
     * @return static
     */
    public function setRateCost($rateCost = null)
    {
        $this->rateCost = $rateCost;

        return $this;
    }

    /**
     * @return string
     */
    public function getRateCost()
    {
        return $this->rateCost;
    }

    /**
     * @param string $rateUnit
     *
     * @return static
     */
    public function setRateUnit($rateUnit = null)
    {
        $this->rateUnit = $rateUnit;

        return $this;
    }

    /**
     * @return string
     */
    public function getRateUnit()
    {
        return $this->rateUnit;
    }

    /**
     * @param string $rateIncrement
     *
     * @return static
     */
    public function setRateIncrement($rateIncrement = null)
    {
        $this->rateIncrement = $rateIncrement;

        return $this;
    }

    /**
     * @return string
     */
    public function getRateIncrement()
    {
        return $this->rateIncrement;
    }

    /**
     * @param string $groupIntervalStart
     *
     * @return static
     */
    public function setGroupIntervalStart($groupIntervalStart = null)
    {
        $this->groupIntervalStart = $groupIntervalStart;

        return $this;
    }

    /**
     * @return string
     */
    public function getGroupIntervalStart()
    {
        return $this->groupIntervalStart;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * @param \Ivoz\Cgr\Domain\Model\Rate\RateDto $rate
     *
     * @return static
     */
    public function setRate(\Ivoz\Cgr\Domain\Model\Rate\RateDto $rate = null)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\Rate\RateDto
     */
    public function getRate()
    {
        return $this->rate;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setRateId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Cgr\Domain\Model\Rate\RateDto($id)
                : null;

            return $this->setRate($value);
        }

        /**
         * @return integer | null
         */
        public function getRateId()
        {
            if ($dto = $this->getRate()) {
                return $dto->getId();
            }

            return null;
        }
}


