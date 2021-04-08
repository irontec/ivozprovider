<?php

namespace Ivoz\Provider\Domain\Model\Language;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* LanguageInterface
*/
interface LanguageInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getIden(): string;

    public function getName(): Name;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
