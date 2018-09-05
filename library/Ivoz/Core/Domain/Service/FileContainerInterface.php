<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Service\TempFile;

interface FileContainerInterface
{
    /**
     * @param $fldName
     * @param TempFile $file
     */
    public function addTmpFile($fldName, TempFile $file);

    /**
     * @param TempFile $file
     * @throws \Exception
     */
    public function removeTmpFile(TempFile $file);

    /**
     * @return array
     */
    public function getFileObjects();


    /**
     * @return TempFile[]
     */
    public function getTempFiles();
}
