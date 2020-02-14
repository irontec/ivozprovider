<?php

namespace Ivoz\Provider\Domain\Model\Feature;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface FeatureInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden();

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Feature\Name
     */
    public function getName();
}
