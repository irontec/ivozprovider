<?php

namespace Ivoz\Core\Domain\Model;

/**
 * Entity interface
 *
 * @author Mikel Madariaga <mikel@irontec.com>
 */
interface LoggableEntityInterface extends EntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();
}
