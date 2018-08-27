<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

class OnErrorEventArgs extends OnCommitEventArgs
{
    /**
     * @var EntityInterface
     */
    protected $entity;

    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * Constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(
        EntityInterface $entity,
        \Exception $exception
    ) {
        $this->entity = $entity;
        $this->exception = $exception;
    }

    /**
     * @return EntityInterface
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }
}
