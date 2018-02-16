<?php

namespace Ivoz\Provider\Domain\Model\EtagVersion;

/**
 * EtagVersion
 */
class EtagVersion extends EtagVersionAbstract implements EtagVersionInterface
{
    use EtagVersionTrait;

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

