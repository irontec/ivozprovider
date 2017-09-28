<?php
namespace Ivoz\Provider\Domain\Model\MusicOnHold;

/**
 * MusicOnHold
 */
class MusicOnHold extends MusicOnHoldAbstract implements MusicOnHoldInterface
{
    use MusicOnHoldTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOwner()
    {
        return 'company' . $this->getCompany()->getId();
    }
}

