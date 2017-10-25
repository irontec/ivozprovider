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
     *
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
        return 'company' . $this->getCompany()->getId();
    }
}

