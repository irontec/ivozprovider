<?php

namespace Ivoz\Provider\Domain\Service\Destination;

use Doctrine\DBAL\Driver\PDOException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Ivoz\Core\Domain\Service\PersistErrorHandlerInterface;

class PersistErrorHandler implements PersistErrorHandlerInterface
{
    const ON_ERROR_PRIORITY = self::PRIORITY_NORMAL;

    /*
     * Mysql error code list:
     * https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
     */
    const MYSQL_ERROR_DUPLICATE_ENTRY = 1062;
    const UNIQUE_PREFIX_CONSTRAINT_NAME = 'prefix';

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
            && strpos($exception->getMessage(), self::UNIQUE_PREFIX_CONSTRAINT_NAME);

        if ($isDuplicatedEmailError) {
            throw new \DomainException(
                'Duplicated prefix',
                2203,
                $exception
            );
        }
    }
}
