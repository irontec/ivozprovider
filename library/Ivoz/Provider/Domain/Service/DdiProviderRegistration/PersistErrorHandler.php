<?php

namespace Ivoz\Provider\Domain\Service\DdiProviderRegistration;

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
    const UNIQUE_USERNAME_DOMAIN_CONSTRAINT = 'ddiProviderRegistration_username_domain';

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
            && strpos($exception->getMessage(), self::UNIQUE_USERNAME_DOMAIN_CONSTRAINT);

        if ($isDuplicatedEmailError) {
            throw new \DomainException('Username-domain already in use', 0, $exception);
        }
    }
}
