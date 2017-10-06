<?php

namespace Ivoz\Core\Domain\Model;

use Ivoz\Core\Domain\Service\TempFile;

trait TempFileContainnerTrait
{
    /**
     * @var TempFile[]
     */
    protected $tmpFiles = [];

    public function addTmpFile(TempFile $file)
    {
        $this->tmpFiles[]  = $file;
    }

    /**
     * @return TempFile[]
     */
    public function getTempFiles()
    {
        return $this->tmpFiles;
    }
}