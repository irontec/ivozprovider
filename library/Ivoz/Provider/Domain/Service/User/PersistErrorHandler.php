<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\PersistErrorHandlerInterface;

/**
 * Class CryptPass
 * @package Ivoz\Provider\Domain\Service\User
 * @lifecycle pre_persist
 */
class PersistErrorHandler implements PersistErrorHandlerInterface
{
    /*
     * Mysql error code list:
     * https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
     */
    const MYSQL_ERROR_DUPLICATE_ENTRY = 1062;
    const UNIQUE_EMAIL_CONSTRAINT_NAME = 'duplicateEmail';

    public function __construct() {}

    public function handle(\Exception $e)
    {
        $isDuplicatedEmailError =
            $e->getCode() === self::MYSQL_ERROR_DUPLICATE_ENTRY
            && strpos($e->getMessage(), self::UNIQUE_EMAIL_CONSTRAINT_NAME);

        if ($isDuplicatedEmailError) {
            throw new \Exception('Email already in use', 2201, $e);
        }

        throw $e;
    }
}