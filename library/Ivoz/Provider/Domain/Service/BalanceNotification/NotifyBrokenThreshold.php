<?php

namespace Ivoz\Provider\Domain\Service\BalanceNotification;

use Ivoz\Core\Domain\Event\DomainEventInterface;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\DomainEventSubscriberTrait;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationInterface;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationRepository;
use Ivoz\Provider\Domain\Model\Company\Events\CompanyBalanceThresholdWasBroken;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
use Ivoz\Core\Infrastructure\Domain\Service\Mailer\Client;
use Ivoz\Core\Domain\Model\Mailer\Message;

class NotifyBrokenThreshold implements DomainEventSubscriberInterface
{
    use DomainEventSubscriberTrait;

    /**
     * @var NotificationTemplateRepository
     */
    protected $notificationTemplateRepository;

    /**
     * @var BalanceNotificationRepository
     */
    protected $balanceNotificationRepository;

    /**
     * @var Client
     */
    protected $mailer;

    public function __construct(
        NotificationTemplateRepository $notificationTemplateRepository,
        BalanceNotificationRepository $balanceNotificationRepository,
        Client $mailer
    ) {
        $this->notificationTemplateRepository = $notificationTemplateRepository;
        $this->balanceNotificationRepository = $balanceNotificationRepository;
        $this->mailer = $mailer;
    }

    /**
     * @param CompanyBalanceThresholdWasBroken $domainEvent
     * @throws \Exception
     * @return void
     */
    public function handle(DomainEventInterface $domainEvent)
    {
        if (!($domainEvent instanceof CompanyBalanceThresholdWasBroken)) {
            throw new \Exception('CompanyBalanceThresholdWasBroken was expected');
        }
        $this->events[] = $domainEvent;

        $this->sendNotification($domainEvent);
    }

    private function sendNotification(CompanyBalanceThresholdWasBroken $event)
    {
        /** @var BalanceNotificationInterface $balanceNotification */
        $balanceNotification = $this->balanceNotificationRepository
            ->find($event->getBalanceNotificationId());

        $notificationTemplate = $this->notificationTemplateRepository
            ->findTemplateByBalanceNotification($balanceNotification);

        $company = $balanceNotification->getCompany();
        $language = $company->getLanguage();
        if (!$language) {
            $language = $company->getBrand()->getLanguage();
        }

        $notificationContent = $notificationTemplate->getContentsByLanguage($language);
        $subject = $this->parseNotificationContent(
            $notificationContent->getSubject(),
            $company->getName(),
            $event->getCurrentBalance()
        );

        $body = $this->parseNotificationContent(
            $notificationContent->getBody(),
            $company->getName(),
            $event->getCurrentBalance()
        );

        $email = new Message();
        $email
            ->setSubject($subject)
            ->setBody($body)
            ->setFromAddress(
                $notificationContent->getFromAddress()
            )
            ->setFromName(
                $notificationContent->getFromName()
            )
            ->setToAddress(
                $balanceNotification->getToAddress()
            );

        $this->mailer->send($email);

    }

    private function parseNotificationContent(string $content, string $companyName, float $currentBalance)
    {
        $substitution = array(
            '${BALANCE_COMPANY}' => $companyName,
            '${BALANCE_AMOUNT}' => $currentBalance
        );

        return str_replace(array_keys($substitution), array_values($substitution), $content);
    }

    /**
     * @param DomainEventInterface $domainEvent
     * @return boolean
     */
    public function isSubscribedTo(DomainEventInterface $domainEvent)
    {
        if ($domainEvent instanceof CompanyBalanceThresholdWasBroken) {
            return true;
        }

        return false;
    }
}