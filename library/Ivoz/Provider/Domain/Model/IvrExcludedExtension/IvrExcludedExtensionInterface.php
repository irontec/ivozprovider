<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;

/**
* IvrExcludedExtensionInterface
*/
interface IvrExcludedExtensionInterface extends LoggableEntityInterface
{

    public function getChangeSet();

    public function setIvr(?IvrInterface $ivr = null): static;

    public function getIvr(): ?IvrInterface;

    public function getExtension(): ExtensionInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
