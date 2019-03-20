<?php

namespace Ivoz\Provider\Domain\Model\Codec;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface CodecInterface extends LoggableEntityInterface
{
    const TYPE_AUDIO = 'audio';
    const TYPE_VIDEO = 'video';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();
}
