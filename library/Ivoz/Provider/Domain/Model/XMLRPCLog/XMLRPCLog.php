<?php
namespace Ivoz\Provider\Domain\Model\XMLRPCLog;

/**
 * XMLRPCLog
 */
class XMLRPCLog extends XMLRPCLogAbstract implements XMLRPCLogInterface
{
    use XMLRPCLogTrait;

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

