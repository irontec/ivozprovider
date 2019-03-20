<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Service\TempFile;

interface FileContainerInterface
{
    /**
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     */
    public function addTmpFile($fldName, TempFile $file);

    /**
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     * @throws \Exception
     */
    public function removeTmpFile(TempFile $file);

    /**
     * @return array
     */
    public function getFileObjects();


    /**
     * @return \Ivoz\Core\Domain\Service\TempFile[]
     */
    public function getTempFiles();
}
