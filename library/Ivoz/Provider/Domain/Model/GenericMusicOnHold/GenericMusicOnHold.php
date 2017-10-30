<?php

namespace Ivoz\Provider\Domain\Model\GenericMusicOnHold;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * GenericMusicOnHold
 */
class GenericMusicOnHold
    extends GenericMusicOnHoldAbstract
    implements GenericMusicOnHoldInterface, FileContainerInterface
{
    use GenericMusicOnHoldTrait;
    use TempFileContainnerTrait;

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
            'encodedFile',
            'originalFile'
        ];
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getOwner()
    {
        return
            'brand'
            . $this->getBrand()->getId();
    }
}

