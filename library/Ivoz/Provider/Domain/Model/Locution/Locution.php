<?php
namespace Ivoz\Provider\Domain\Model\Locution;
use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * Locution
 */
class Locution extends LocutionAbstract implements LocutionInterface, FileContainerInterface
{
    use LocutionTrait;
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
            'OriginalFile',
            'EncodedFile'
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

