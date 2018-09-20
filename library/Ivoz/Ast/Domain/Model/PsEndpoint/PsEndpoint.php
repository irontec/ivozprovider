<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Ivoz\Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * PsEndpoint
 */
class PsEndpoint extends PsEndpointAbstract implements PsEndpointInterface
{
    use PsEndpointTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
