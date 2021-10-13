<?php

namespace Ivoz\Provider\Domain\Model\Codec;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CodecInterface
*/
interface CodecInterface extends LoggableEntityInterface
{
    public const TYPE_AUDIO = 'audio';

    public const TYPE_VIDEO = 'video';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getType(): string;

    public function getIden(): string;

    public function getName(): string;

    public function isInitialized(): bool;
}
