<?php
namespace Ivoz\Provider\Domain\Model\ParsedCdr;

/**
 * ParsedCdr
 */
class ParsedCdr extends ParsedCdrAbstract implements ParsedCdrInterface
{
    use ParsedCdrTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

