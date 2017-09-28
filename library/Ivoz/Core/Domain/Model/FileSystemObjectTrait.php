<?php

namespace Ivoz\Core\Domain\Model;

/**
 * FSO interface
 *
 * @author Mikel Madariaga <mikel@irontec.com>
 */
trait FileSystemObjectTrait
{
    protected $fileSize;
    protected $mimeType;
    protected $baseName;

    protected $filePath;

    public function getFilePath()
    {

    }

    public function fetch($pk) {}

    public function put($filePath) {}

    public function flush($pk) {}
}
