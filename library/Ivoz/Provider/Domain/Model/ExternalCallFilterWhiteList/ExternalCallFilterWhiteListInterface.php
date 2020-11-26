<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList;

use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ExternalCallFilterWhiteListInterface
*/
interface ExternalCallFilterWhiteListInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set filter
     *
     * @param ExternalCallFilterInterface | null
     *
     * @return static
     */
    public function setFilter(?ExternalCallFilterInterface $filter = null): ExternalCallFilterWhiteListInterface;

    /**
     * Get filter
     *
     * @return ExternalCallFilterInterface | null
     */
    public function getFilter(): ?ExternalCallFilterInterface;

    /**
     * Get matchlist
     *
     * @return MatchListInterface
     */
    public function getMatchlist(): MatchListInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
