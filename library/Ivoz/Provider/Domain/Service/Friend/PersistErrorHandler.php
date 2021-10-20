<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Doctrine\DBAL\Driver\PDOException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Ivoz\Core\Domain\Service\PersistErrorHandlerInterface;

class PersistErrorHandler implements PersistErrorHandlerInterface
{
    public const ON_ERROR_PRIORITY = self::PRIORITY_NORMAL;

    /*
     * Mysql error code list:
     * https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
     */
    public const MYSQL_ERROR_DUPLICATE_ENTRY = 1062;
    public const UNIQUE_PRIORITY_CONSTRAINT_NAME = 'companyPrio';

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_ERROR => self::ON_ERROR_PRIORITY,
        ];
    }

    public function handle(\Throwable $exception)
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
            && strpos($exception->getMessage(), self::UNIQUE_PRIORITY_CONSTRAINT_NAME);

        if ($isDuplicatedEmailError) {
            throw new \DomainException('Duplicated priority', 2202, $exception);
        }
    }
}
