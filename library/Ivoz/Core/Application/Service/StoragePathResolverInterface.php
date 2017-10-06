<?php

namespace Ivoz\Core\Application\Service;

interface StoragePathResolverInterface
{
    public function getFilePath($id);
}