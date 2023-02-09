<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelMatchList;

/**
 * CallAclRelPattern
 */
class CallAclRelMatchList extends CallAclRelMatchListAbstract implements CallAclRelMatchListInterface
{
    use CallAclRelMatchListTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }


    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
