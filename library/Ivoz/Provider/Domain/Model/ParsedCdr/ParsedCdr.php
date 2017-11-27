<?php
namespace Ivoz\Provider\Domain\Model\ParsedCdr;

/**
 * ParsedCdr
 */
class ParsedCdr extends ParsedCdrAbstract implements ParsedCdrInterface
{
    use ParsedCdrTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
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

