<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* IvrExcludedExtensionInterface
*/
interface IvrExcludedExtensionInterface extends LoggableEntityInterface
{

    public function getChangeSet();

    /**
     * Set ivr
     *
     * @param IvrInterface | null
     *
     * @return static
     */
    public function setIvr(?IvrInterface $ivr = null): IvrExcludedExtensionInterface;

    /**
     * Get ivr
     *
     * @return IvrInterface | null
     */
    public function getIvr(): ?IvrInterface;

    /**
     * Get extension
     *
     * @return ExtensionInterface
     */
    public function getExtension(): ExtensionInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
