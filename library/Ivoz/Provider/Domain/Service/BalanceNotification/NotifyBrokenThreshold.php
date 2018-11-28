<?php

namespace Ivoz\Provider\Domain\Service\BalanceNotification;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Event\DomainEventInterface;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\DomainEventSubscriberTrait;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationDto;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationInterface;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationRepository;
use Ivoz\Provider\Domain\Events\AbstractBalanceThresholdWasBroken;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
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
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var MailerClientInterface
     */
    protected $mailer;

    public function __construct(
        NotificationTemplateRepository $notificationTemplateRepository,
        BalanceNotificationRepository $balanceNotificationRepository,
        EntityTools $entityTools,
        MailerClientInterface $mailer
    ) {
        $this->notificationTemplateRepository = $notificationTemplateRepository;
        $this->balanceNotificationRepository = $balanceNotificationRepository;
        $this->entityTools = $entityTools;
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
        $balanceNotificationDto->setLastSent(new \DateTime());
        $this->entityTools->persistDto(
            $balanceNotificationDto,
            $balanceNotification,
            false
        );
    }

    private function parseNotificationContent(string $content, string $name, float $currentBalance)
    {
        $substitution = array(
            '${BALANCE_NAME}' => $name,
            '${BALANCE_AMOUNT}' => $currentBalance
        );

        return str_replace(array_keys($substitution), array_values($substitution), $content);
    }
}
