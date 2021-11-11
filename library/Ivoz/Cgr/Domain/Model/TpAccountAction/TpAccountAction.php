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
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }
}
