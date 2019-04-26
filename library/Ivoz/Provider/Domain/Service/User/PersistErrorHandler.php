<?php

namespace Ivoz\Provider\Domain\Service\User;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Ivoz\Core\Domain\Service\PersistErrorHandlerInterface;
use Doctrine\DBAL\Driver\PDOException;

class PersistErrorHandler implements PersistErrorHandlerInterface
{
    const ON_ERROR_PRIORITY = self::PRIORITY_NORMAL;

    /*
     * Mysql error code list:
     * https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
     */
    const MYSQL_ERROR_DUPLICATE_ENTRY = 1062;
    const UNIQUE_EMAIL_CONSTRAINT_NAME = 'duplicateEmail';

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_ERROR => self::ON_ERROR_PRIORITY,
        ];
    }

    public function handle(\Exception $exception)
    {
        if (!$exception instanceof UniqueConstraintViolationException) {
            return;
        }

        $pdoException = $exception->getPrevious();
        if (!$pdoException instanceof PDOException) {
            return;
        }

        $isDuplicatedEmailError =
            $pdoException->getErrorCode() === self::MYSQL_ERROR_DUPLICATE_ENTRY
            && strpos($exception->getMessage(), self::UNIQUE_EMAIL_CONSTRAINT_NAME);

        if ($isDuplicatedEmailError) {
            throw new \DomainException('Email already in use', 2201, $exception);
        }
    }
}
