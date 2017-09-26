<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServer;

/**
 * ApplicationServer
 */
class ApplicationServer extends ApplicationServerAbstract implements ApplicationServerInterface
{
    use ApplicationServerTrait;

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

