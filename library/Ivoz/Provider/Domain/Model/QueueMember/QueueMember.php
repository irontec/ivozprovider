<?php

namespace Ivoz\Provider\Domain\Model\QueueMember;

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
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAstQueueMemberName(): string
    {
        $queue = $this->getQueue();
        $company = $queue->getCompany();
        $brand = $company->getBrand();

        return sprintf(
            "b%dc%dq%dm%d_%d",
            (int) $brand->getId(),
            (int) $company->getId(),
            (int) $queue->getId(),
            (int) $this->getId(),
            time(),
        );
    }
}
