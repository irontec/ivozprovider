<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

/**
 * CompanyRelCodec
 * @codeCoverageIgnore
 */
class CompanyRelCodec extends CompanyRelCodecAbstract implements CompanyRelCodecInterface
{
    use CompanyRelCodecTrait;

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
