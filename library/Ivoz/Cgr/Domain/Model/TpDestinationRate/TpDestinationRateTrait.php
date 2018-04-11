<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * TpDestinationRateTrait
 * @codeCoverageIgnore
 */
trait TpDestinationRateTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface
     */
    protected $tpDestination;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface
     */
    protected $tpRate;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());

    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpDestinationRateDto
         */
        $self = parent::fromDto($dto);

        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpDestinationRateDto
         */
        parent::updateFromDto($dto);

        return $this;
    }

    /**
     * @param int $depth
     * @return TpDestinationRateDto
     */
    public function toDto($depth = 0)
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }


    /**
     * Set tpDestination
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination
     *
     * @return self
     */
    public function setTpDestination(\Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination = null)
    {
        $this->tpDestination = $tpDestination;

        return $this;
    }

    /**
     * Get tpDestination
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface
     */
    public function getTpDestination()
    {
        return $this->tpDestination;
    }

    /**
     * Set tpRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate
     *
     * @return self
     */
    public function setTpRate(\Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface $tpRate = null)
    {
        $this->tpRate = $tpRate;

        return $this;
    }

    /**
     * Get tpRate
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRate\TpRateInterface
     */
    public function getTpRate()
    {
        return $this->tpRate;
    }


}

