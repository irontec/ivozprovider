<?php

namespace Ivoz\Core\Infrastructure\Persistence\Filesystem;

class TempFileHelper
{
    public function createWithContent($content)
    {
        $tmpfile = tmpfile();
        fwrite(
            $tmpfile,
            $content
        );
        fseek($tmpfile, 0);

        return $tmpfile;
    }
}
