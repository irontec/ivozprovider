<?php

namespace Ivoz\Provider\Domain\Model\Language;

use Ivoz\Core\Domain\Model\EntityInterface;

interface LanguageInterface extends EntityInterface
{
    /**
     * Set iden
     *
     * @param string $iden
     *
     * @return self
     */
    public function setIden($iden);

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden();

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\Language\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\Language\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Language\Name
     */
    public function getName();

}

