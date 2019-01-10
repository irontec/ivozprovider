<?php

namespace spec\Ivoz\Provider\Domain\Service\BalanceNotification;

use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface;
use Ivoz\Provider\Domain\Service\BalanceNotification\NotifyBrokenThreshold;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Event\DomainEventInterface;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\DomainEventCollectorTrait;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationInterface;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationRepository;
use Ivoz\Provider\Domain\Events\AbstractBalanceThresholdWasBroken;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
use Ivoz\Core\Domain\Model\Mailer\Message;
use spec\HelperTrait;

class NotifyBrokenThresholdSpec extends ObjectBehavior
{
    use HelperTrait;

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

    public function let(
        NotificationTemplateRepository $notificationTemplateRepository,
        BalanceNotificationRepository $balanceNotificationRepository,
        EntityTools $entityTools,
        MailerClientInterface $mailer
    ) {
        $this->notificationTemplateRepository = $notificationTemplateRepository;
        $this->balanceNotificationRepository = $balanceNotificationRepository;
        $this->entityTools = $entityTools;
        $this->mailer = $mailer;

        $this->beConstructedWith(
            $notificationTemplateRepository,
            $balanceNotificationRepository,
            $entityTools,
            $mailer
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NotifyBrokenThreshold::class);
    }

    function it_throw_exception_on_unexpected_event(
        DomainEventInterface $domainEvent
    ) {
        $this
            ->shouldThrow(\Exception::class)
            ->during('handle', [$domainEvent]);
    }

    function it_sends_an_email(
        AbstractBalanceThresholdWasBroken $event,
        BalanceNotificationInterface $balanceNotification,
        NotificationTemplateInterface $notificationTemplate,
        CarrierInterface $carrier,
        BrandInterface $brand,
        LanguageInterface $language,
        NotificationTemplateContentInterface $notificationContent,
        BalanceNotificationDto $balanceNotificationDto
    ) {
        $this->prepareExecution(
            $event,
            $balanceNotification,
            $notificationTemplate,
            $carrier,
            $brand,
            $language,
            $notificationContent,
            $balanceNotificationDto
        );

        $this
            ->mailer
            ->send(Argument::type(Message::class))
            ->shouldBeCalled();

        $this->handle($event);
    }

    /**
     * @param AbstractBalanceThresholdWasBroken $event
     * @param BalanceNotificationInterface $balanceNotification
     * @param NotificationTemplateInterface $notificationTemplate
     * @param CarrierInterface $carrier
     * @param BrandInterface $brand
     * @param LanguageInterface $language
     * @param NotificationTemplateContentInterface $notificationContent
     * @param BalanceNotificationDto $balanceNotificationDto
     */
    protected function prepareExecution(
        AbstractBalanceThresholdWasBroken $event,
        BalanceNotificationInterface $balanceNotification,
        NotificationTemplateInterface $notificationTemplate,
        CarrierInterface $carrier,
        BrandInterface $brand,
        LanguageInterface $language,
        NotificationTemplateContentInterface $notificationContent,
        BalanceNotificationDto $balanceNotificationDto
    ) {
        $event
            ->getBalanceNotificationId()->willReturn(1);
        $event
            ->getCurrentBalance()->willReturn(9.5);

        $this->balanceNotificationRepository
            ->find(Argument::any())->willReturn($balanceNotification);

        $this->getterProphecy(
            $balanceNotification,
            [
                'getCarrier' => $carrier,
                'getToAddress' => '',
                'getLanguage' => $language,
                'getEntityName' => ''
            ],
            false
        );

        $this->getterProphecy(
            $carrier,
            [
                'getName' => '',
                'getBrand' => $brand
            ],
            false
        );

        $brand
            ->getLanguage()->willReturn($language);

        $this->notificationTemplateRepository
            ->findTemplateByBalanceNotification($balanceNotification)->willReturn($notificationTemplate);

        $notificationTemplate
            ->getContentsByLanguage($language)->willReturn($notificationContent);

        $this->getterProphecy(
            $notificationContent,
            [
                'getSubject' => '',
                'getBody' => '',
                'getFromAddress' => '',
                'getFromName' => '',
                'getBodyType' => 'text/plain'
            ],
            false
        );

        $this->entityTools
            ->entityToDto($balanceNotification)->willReturn($balanceNotificationDto);
        $this->entityTools
            ->persistDto(
                Argument::any(),
                Argument::any(),
                Argument::any()
            )->willReturn(Argument::any());
    }
}
