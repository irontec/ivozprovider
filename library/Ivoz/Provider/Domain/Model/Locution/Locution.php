<?php
namespace Ivoz\Provider\Domain\Model\Locution;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
 * Locution
 */
class Locution extends LocutionAbstract implements FileContainerInterface, LocutionInterface
{
    use LocutionTrait;
    use TempFileContainnerTrait { addTmpFile as protected _addTmpFile;
    }

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
     * @codeCoverageIgnore
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add TempFile and set status to pending
     *
     * @param $fldName
     * @param TempFile $file
     */
    public function addTmpFile($fldName, TempFile $file)
    {
        if ($fldName == 'OriginalFile') {
            $this->setStatus('pending');
        }
        $this->_addTmpFile($fldName, $file);
    }
}
