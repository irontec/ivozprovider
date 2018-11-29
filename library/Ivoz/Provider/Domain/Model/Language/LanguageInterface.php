<?php

namespace Ivoz\Provider\Domain\Model\Language;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface LanguageInterface extends LoggableEntityInterface
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
