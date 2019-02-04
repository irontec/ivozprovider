<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

/**
 * TpAccountAction
 */
class TpAccountAction extends TpAccountActionAbstract implements TpAccountActionInterface
{
    use TpAccountActionTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }
}
