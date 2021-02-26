<?php

namespace Ivoz\Ast\Domain\Model\Queue;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* QueueInterface
*/
interface QueueInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getName(): string;

    public function getPeriodicAnnounce(): ?string;

    public function getPeriodicAnnounceFrequency(): ?int;

    public function getTimeout(): ?int;

    public function getAutopause(): string;

    public function getRinginuse(): string;

    public function getWrapuptime(): ?int;

    public function getMaxlen(): ?int;

    public function getStrategy(): ?string;

    public function getWeight(): ?int;

    public function getQueue(): \Ivoz\Provider\Domain\Model\Queue\QueueInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
