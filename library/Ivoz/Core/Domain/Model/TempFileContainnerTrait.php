<?php

namespace Ivoz\Core\Domain\Model;

use Ivoz\Core\Domain\Service\TempFile;

trait TempFileContainnerTrait
{
    /**
     * @var TempFile[]
     */
    protected $tmpFiles = [];

    public function addTmpFile($fldName, TempFile $file)
    {
        $this->tmpFiles[$fldName]  = $file;
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