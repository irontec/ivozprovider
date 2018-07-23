<?php

namespace Ivoz\Core\Domain\Model;

use Ivoz\Core\Domain\Service\TempFile;

trait TempFileContainnerTrait
{
    /**
     * @var TempFile[]
     */
    protected $tmpFiles = [];

    /**
     * @param $fldName
     * @param TempFile $file
     */
    public function addTmpFile($fldName, TempFile $file)
    {
        $this->tmpFiles[$fldName]  = $file;
    }

    /**
     * @param TempFile $file
     * @throws \Exception
     */
    public function removeTmpFile(TempFile $file)
    {
        $position = array_search($file, $this->tmpFiles);
        if ($position === false) {
            throw new \Exception('File not found');
        }

        unset($this->tmpFiles[$position]);
    }

    /**
     * @return TempFile[]
     */
    public function getTempFiles()
    {
        return $this->tmpFiles;
    }

    /**
     * @var string $fldName
     * @return null | TempFile
     */
    public function getTempFileByFieldName($fldName)
    {
        if (array_key_exists($fldName, $this->tmpFiles)) {
            return $this->tmpFiles[$fldName];
        }

        return null;
    }
}