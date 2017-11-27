<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * MusicOnHold
 */
class MusicOnHold extends MusicOnHoldAbstract implements MusicOnHoldInterface, FileContainerInterface
{
    use MusicOnHoldTrait;
    use TempFileContainnerTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * @return array
     */
    public function getFileObjects()
    {
        return [
            'OriginalFile',
            'EncodedFile'
        ];
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

    /**
     * @return string
     */
    public function getOwner()
    {
        if ($this->getBrand()) {
            return 'brand' . $this->getBrand()->getId();
        }

        if ($this->getCompany()) {
            return 'company' . $this->getCompany()->getId();
        }
    }
}

