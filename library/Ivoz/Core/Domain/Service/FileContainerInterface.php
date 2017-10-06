<?php

namespace Ivoz\Core\Domain\Service;

interface FileContainerInterface
{
    /**
     * @return array
     */
    public function getFileObjects();

    public function addTmpFile(TempFile $file);

    /**
     * @return TempFile[]
     */
    public function getTempFiles();
}