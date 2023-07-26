<?php

namespace Ivoz\Ast\Domain\Model\QueueMember;

/**
 * QueueMember
 */
class QueueMember extends QueueMemberAbstract implements QueueMemberInterface
{
    use QueueMemberTrait;

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
     */
    public function getId(): null|string|int
    {
        return $this->id;
    }
}
