<?php

namespace Ivoz\Provider\Domain\Service\BalanceNotification;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Event\DomainEventInterface;
use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Ivoz\Provider\Domain\Events\AbstractBalanceThresholdWasBroken;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationDto;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationInterface;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationRepository;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;

class NotifyBrokenThreshold implements DomainEventSubscriberInterface
{
    public function __construct(
        private NotificationTemplateRepository $notificationTemplateRepository,
        private BalanceNotificationRepository $balanceNotificationRepository,
        private EntityTools $entityTools,
        private MailerClientInterface $mailer
    ) {
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

        $this->sendNotification($domainEvent);
    }

    /**
     * @param DomainEventInterface $domainEvent
     * @return boolean
     */
    public function isSubscribedTo(DomainEventInterface $domainEvent)
    {
        return $domainEvent instanceof AbstractBalanceThresholdWasBroken;
    }

    /**
     * @return void
     */
    private function sendNotification(AbstractBalanceThresholdWasBroken $event)
    {
        /** @var BalanceNotificationInterface $balanceNotification */
        $balanceNotification = $this->balanceNotificationRepository
            ->find($event->getBalanceNotificationId());

        /** @var NotificationTemplateInterface $notificationTemplate */
        $notificationTemplate = $this->notificationTemplateRepository
            ->findTemplateByBalanceNotification($balanceNotification);

        $name = $balanceNotification->getEntityName();
        $language = $balanceNotification->getLanguage();

        $notificationContent = $notificationTemplate->getContentsByLanguage($language);
        $subject = $this->parseNotificationContent(
            $notificationContent->getSubject(),
            $name,
            $event->getCurrentBalance()
        );
        $bodyType = $notificationContent->getBodyType();

        $body = $this->parseNotificationContent(
            $notificationContent->getBody(),
            $name,
            $event->getCurrentBalance()
        );

        $email = new Message();
        $email
            ->setSubject($subject)
            ->setBody($body, $bodyType)
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

        /** @var BalanceNotificationDto $balanceNotificationDto */
        $balanceNotificationDto = $this->entityTools->entityToDto($balanceNotification);
        $balanceNotificationDto->setLastSent(
            new \DateTime(
                'now',
                new \DateTimeZone('UTC')
            )
        );
        $this->entityTools->persistDto(
            $balanceNotificationDto,
            $balanceNotification,
            false
        );
    }

    private function parseNotificationContent(string $content, string $name, float $currentBalance): string
    {
        $substitution = array(
            '${BALANCE_NAME}' => $name,
            '${BALANCE_AMOUNT}' => $currentBalance
        );

        return str_replace(array_keys($substitution), array_values($substitution), $content);
    }
}
