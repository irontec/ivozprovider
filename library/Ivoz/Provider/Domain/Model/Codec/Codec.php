<?php

namespace Ivoz\Provider\Domain\Model\Codec;

/**
 * Codec
 */
class Codec extends CodecAbstract implements CodecInterface
{
    use CodecTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
