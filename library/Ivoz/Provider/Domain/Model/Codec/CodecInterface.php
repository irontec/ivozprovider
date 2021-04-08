<?php

namespace Ivoz\Provider\Domain\Model\Codec;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CodecInterface
*/
interface CodecInterface extends LoggableEntityInterface
{
    const TYPE_AUDIO = 'audio';

    const TYPE_VIDEO = 'video';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getType(): string;

    public function getIden(): string;

    public function getName(): string;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
