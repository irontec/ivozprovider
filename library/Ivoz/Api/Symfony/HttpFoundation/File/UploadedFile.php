<?php

namespace Ivoz\Api\Symfony\HttpFoundation\File;

use Symfony\Component\HttpFoundation\File\UploadedFile as SymfonyUploadedFile;

/**
 * Copied from a rejected symfony PR
 * @see https://github.com/symfony/symfony/pull/10381/
 */
class UploadedFile extends SymfonyUploadedFile
{
    /**
     * List of files that were uploaded outside of PHP's standard POST multipart/form-data method.
     *
     * @var array
     */
    public static $files = array();

    public function isValid()
    {
        return
            parent::isValid()
            || in_array($this->getPathname(), self::$files);
    }
}
