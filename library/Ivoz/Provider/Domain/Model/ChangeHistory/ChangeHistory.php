<?php

namespace Ivoz\Provider\Domain\Model\ChangeHistory;

/**
 * ChangeHistory
 */
class ChangeHistory extends ChangeHistoryAbstract implements ChangeHistoryInterface
{
    use ChangeHistoryTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

