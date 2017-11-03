<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface DomainInterface extends LoggableEntityInterface
{
    public function getChangeSet();

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return self
     */
    public function setDomain($domain);

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain();

    /**
     * Set pointsTo
     *
     * @param string $pointsTo
     *
     * @return self
     */
    public function setPointsTo($pointsTo);

    /**
     * Get pointsTo
     *
     * @return string
     */
    public function getPointsTo();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

}

