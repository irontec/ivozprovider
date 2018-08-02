<?php

namespace Ivoz\Provider\Domain\Service\BalanceNotification;

use Ivoz\Core\Domain\Event\DomainEventInterface;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\DomainEventSubscriberTrait;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationInterface;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationRepository;
use Ivoz\Provider\Domain\Events\AbstractBalanceThresholdWasBroken;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
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
     * @param AbstractBalanceThresholdWasBroken $domainEvent
     * @throws \Exception
     * @return void
     */
    public function handle(DomainEventInterface $domainEvent)
    {
        if (!($domainEvent instanceof AbstractBalanceThresholdWasBroken)) {
            throw new \Exception('AbstractBalanceThresholdWasBroken was expected');
        }
        $this->events[] = $domainEvent;

        $this->sendNotification($domainEvent);
    }

    private function sendNotification(AbstractBalanceThresholdWasBroken $event)
    {
        /** @var BalanceNotificationInterface $balanceNotification */
        $balanceNotification = $this->balanceNotificationRepository
            ->find($event->getBalanceNotificationId());

        $notificationTemplate = $this->notificationTemplateRepository
            ->findTemplateByBalanceNotification($balanceNotification);

        $name = $this->getEntityName($balanceNotification);
        $language = $this->getLanguage($balanceNotification);

        $notificationContent = $notificationTemplate->getContentsByLanguage($language);
        $subject = $this->parseNotificationContent(
            $notificationContent->getSubject(),
            $name,
            $event->getCurrentBalance()
        );

        $body = $this->parseNotificationContent(
            $notificationContent->getBody(),
            $name,
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
        if ($domainEvent instanceof AbstractBalanceThresholdWasBroken) {
            return true;
        }

        return false;
    }

    /**
     * @param BalanceNotificationInterface $balanceNotification
     * @return LanguageInterface
     */
    private function getLanguage(BalanceNotificationInterface $balanceNotification)
    {
        $carrier = $balanceNotification->getCarrier();
        if ($carrier) {

            return $carrier
                ->getBrand()
                ->getLanguage();
        }

        $company = $balanceNotification->getCompany();
        $language = $company->getLanguage();
        if (!$language) {
            $language = $company
                ->getBrand()
                ->getLanguage();
        }

        return $language;
    }

    /**
     * @param BalanceNotificationInterface $balanceNotification
     * @return mixed
     */
    private function getEntityName(BalanceNotificationInterface $balanceNotification)
    {
        $carrier = $balanceNotification->getCarrier();
        if ($carrier) {
            return $carrier->getName();
        }

        return $balanceNotification
            ->getCompany()
            ->getName();
    }
}