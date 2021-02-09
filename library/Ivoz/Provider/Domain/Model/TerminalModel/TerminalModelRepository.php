<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface TerminalModelRepository extends ObjectRepository, Selectable
{
    /**
     * @return TerminalModelInterface | null
     */
    public function findOneByName(string $name);
}
