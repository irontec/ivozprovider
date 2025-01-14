<?php

namespace Service;

class FileUnlinker
{
    public function execute(string $fileName): void
    {
        unlink($fileName);
    }
}
