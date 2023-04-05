<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;

interface TerminalModelRepository extends ObjectRepository, Selectable
{
    /**
     * @return TerminalModelInterface | null
     */
    public function findOneByIden(string $iden);

    public function findOneByGenericUrlPattern(string $genericUrlPattern): ?TerminalModelInterface;
}
