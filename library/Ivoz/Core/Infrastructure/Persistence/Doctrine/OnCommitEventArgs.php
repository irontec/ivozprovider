<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine;

use Doctrine\Common\EventArgs;
use Doctrine\ORM\EntityManagerInterface;

class OnCommitEventArgs extends EventArgs
{
    private $em;

    /**
     * Constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Retrieves associated EntityManager.
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->em;
    }
}
