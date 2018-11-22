<?php

namespace spec\Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\CallCsvReport\EmailSender;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class EmailSenderSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var NotificationTemplateRepository
     */
    protected $notificationTemplateRepository;

    /**
     * @var MailerClientInterface
     */
    protected $mailer;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function let(
        EntityTools $entityTools,
        NotificationTemplateRepository $notificationTemplateRepository,
        MailerClientInterface $mailer,
        LoggerInterface $logger
    ) {
        $this->entityTools = $entityTools;
        $this->notificationTemplateRepository = $notificationTemplateRepository;
        $this->mailer = $mailer;
        $this->logger = $logger;

        $this->beConstructedWith(
            $this->entityTools,
            $this->notificationTemplateRepository,
            $this->mailer,
            $this->logger
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EmailSender::class);
    }

    public function it_sends_emails(
        CallCsvReportInterface $callCsvReport,
        CallCsvSchedulerInterface $callCsvScheduler,
        CompanyInterface $company,
        TimezoneInterface $timezone,
        LanguageInterface $language,
        NotificationTemplateInterface $genericInvoiceNotificationTemplate,
        NotificationTemplateContentInterface $notificationTemplateContent
    ) {
        $this->prepareExecution(
            $callCsvReport,
            $callCsvScheduler,
            $company,
            $timezone,
            $language,
            $genericInvoiceNotificationTemplate,
            $notificationTemplateContent
        );

        $this
            ->mailer
            ->send(
                Argument::type(Message::class)
            )
            ->shouldBeCalled();

        $this->execute($callCsvReport);
    }

    public function it_prioritizes_company_notification_template(
        CallCsvReportInterface $callCsvReport,
        CallCsvSchedulerInterface $callCsvScheduler,
        CompanyInterface $company,
        TimezoneInterface $timezone,
        LanguageInterface $language,
        NotificationTemplateInterface $notificationTemplate,
        NotificationTemplateContentInterface $notificationTemplateContent
    ) {
        $this->prepareExecution(
            $callCsvReport,
            $callCsvScheduler,
            $company,
            $timezone,
            $language,
            $notificationTemplate,
            $notificationTemplateContent
        );

        $company
            ->getCallCsvNotificationTemplate()
            ->willReturn($notificationTemplate)
            ->shouldBeCalled();

        $this
            ->notificationTemplateRepository
            ->findGenericCallCsvTemplate()
            ->shouldNotBeCalled();

        $this->execute($callCsvReport);
    }

    public function it_uses_generic_notification_template_as_fallback(
        CallCsvReportInterface $callCsvReport,
        CallCsvSchedulerInterface $callCsvScheduler,
        CompanyInterface $company,
        TimezoneInterface $timezone,
        LanguageInterface $language,
        NotificationTemplateInterface $notificationTemplate,
        NotificationTemplateContentInterface $notificationTemplateContent
    ) {
        $this->prepareExecution(
            $callCsvReport,
            $callCsvScheduler,
            $company,
            $timezone,
            $language,
            $notificationTemplate,
            $notificationTemplateContent
        );

        $company
            ->getCallCsvNotificationTemplate()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->notificationTemplateRepository
            ->findGenericCallCsvTemplate()
            ->willReturn($notificationTemplate)
            ->shouldBeCalled();

        $this->execute($callCsvReport);
    }

    public function it_logs_errors_and_throws_domain_exception(
        CallCsvReportInterface $callCsvReport,
        CallCsvSchedulerInterface $callCsvScheduler,
        CompanyInterface $company,
        TimezoneInterface $timezone,
        LanguageInterface $language,
        NotificationTemplateInterface $genericInvoiceNotificationTemplate,
        NotificationTemplateContentInterface $notificationTemplateContent
    ) {
        $this->prepareExecution(
            $callCsvReport,
            $callCsvScheduler,
            $company,
            $timezone,
            $language,
            $genericInvoiceNotificationTemplate,
            $notificationTemplateContent
        );

        $this
            ->mailer
            ->send(Argument::any())
            ->willThrow(new \Exception('Some Error'));

        $this
            ->logger
            ->error(Argument::any())
            ->shouldBeCalled();

        $this
            ->shouldThrow(\Exception::class)
            ->during('execute', [$callCsvReport, true]);
    }

    public function it_does_nothing_if_not_new(
        CallCsvReportInterface $callCsvReport
    ) {
        $callCsvReport
            ->isNew()
            ->willReturn(false)
            ->shouldBeCalled();

        $callCsvReport
            ->getCallCsvScheduler()
            ->willReturn(null)
            ->shouldNotBeCalled();

        $this->execute($callCsvReport);
    }

    public function it_does_nothing_with_empty_scheduler(
        CallCsvReportInterface $callCsvReport
    ) {
        $callCsvReport
            ->isNew()
            ->willReturn(true)
            ->shouldBeCalled();

        $callCsvReport
            ->getCallCsvScheduler()
            ->willReturn(null)
            ->shouldBeCalled();

        $callCsvReport
            ->getSentTo()
            ->shouldNotBeCalled();

        $this->execute($callCsvReport);
    }

    public function it_does_nothing_with_empty_target_email(
        CallCsvReportInterface $callCsvReport,
        CallCsvSchedulerInterface $callCsvScheduler
    ) {
        $callCsvReport
            ->isNew()
            ->willReturn(true)
            ->shouldBeCalled();

        $callCsvReport
            ->getCallCsvScheduler()
            ->willReturn($callCsvScheduler)
            ->shouldBeCalled();

        $callCsvReport
            ->getSentTo()
            ->willReturn('')
            ->shouldBeCalled();

        $callCsvReport
            ->getCompany()
            ->shouldNotBeCalled();

        $this->execute($callCsvReport);
    }

    protected function prepareExecution(
        CallCsvReportInterface $callCsvReport,
        CallCsvSchedulerInterface $callCsvScheduler,
        CompanyInterface $company,
        TimezoneInterface $timezone,
        LanguageInterface $language,
        NotificationTemplateInterface $genericInvoiceNotificationTemplate,
        NotificationTemplateContentInterface $notificationTemplateContent
    ) {
        $this
            ->notificationTemplateRepository
            ->findGenericCallCsvTemplate()
            ->willReturn($genericInvoiceNotificationTemplate);

        $genericInvoiceNotificationTemplate
            ->getContentsByLanguage(
                Argument::type(LanguageInterface::class)
            )
            ->willReturn($notificationTemplateContent);

        $this->getterProphecy(
            $callCsvReport,
            [
                'isNew' => true,
                'getCallCsvScheduler' => $callCsvScheduler,
                'getSentTo' => 'mikel@somewhere.com',
                'getCompany' => $company,
                'getInDate' => new \DateTime('2015-01-01 01:01:01'),
                'getOutDate' => new \DateTime('2017-01-01 01:01:01')
            ],
            false
        );

        $this->getterProphecy(
            $company,
            [
                'getDefaultTimezone' => $timezone,
                'getName' => 'Mikel',
                'getLanguage' => $language,
                'getCallCsvNotificationTemplate' => null,
            ],
            false
        );

        $timezone
            ->getTz()
            ->willReturn('UTC');

        $this->getterProphecy(
            $notificationTemplateContent,
            [
                'getFromName' => 'Name',
                'getFromAddress' => 'Address',
                'getBody' => 'Body',
                'getSubject' => 'Subject'
            ],
            false
        );

        $callCsvReportDto = new CallCsvReportDto();
        $callCsvReportDto
            ->setCsvPath('/tmp/file')
            ->getCsvBaseName('myCsv');

        $this
            ->entityTools
            ->entityToDto(
                Argument::type(CallCsvReportInterface::class)
            )
            ->willReturn($callCsvReportDto);
    }
}
