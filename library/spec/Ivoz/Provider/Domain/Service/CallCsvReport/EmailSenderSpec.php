<?php

namespace spec\Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\CallCsvReport\EmailSender;
use Ivoz\Provider\Domain\Service\NotificationTemplateContent\CallCsvNotificationTemplateByCallCsvReport;
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
     * @var CallCsvNotificationTemplateByCallCsvReport
     */
    protected $callCsvNotificationTemplateByCallCsvReport;

    /**
     * @var MailerClientInterface
     */
    protected $mailer;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var CallCsvReportInterface
     */
    protected $callCsvReport;

    /**
     * @var CallCsvSchedulerInterface
     */
    protected $callCsvScheduler;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var TimezoneInterface
     */
    protected $timezone;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var NotificationTemplateContentInterface
     */
    protected $notificationTemplateContent;

    /**
     * @var CallCsvReportDto
     */
    protected $callCsvReportDto;

    public function let(
        EntityTools $entityTools,
        CallCsvNotificationTemplateByCallCsvReport $callCsvNotificationTemplateByCallCsvReport,
        MailerClientInterface $mailer,
        LoggerInterface $logger
    ) {
        $this->entityTools = $entityTools;
        $this->callCsvNotificationTemplateByCallCsvReport = $callCsvNotificationTemplateByCallCsvReport;
        $this->mailer = $mailer;
        $this->logger = $logger;

        $this->beConstructedWith(
            $this->entityTools,
            $this->callCsvNotificationTemplateByCallCsvReport,
            $this->mailer,
            $this->logger
        );

        $this->prepareExecution();
    }

    protected function prepareExecution()
    {
        $this->callCsvReport = $this->getTestDouble(
            CallCsvReportInterface::class
        );

        $this->callCsvScheduler = $this->getTestDouble(
            CallCsvSchedulerInterface::class
        );

        $this->company = $this->getTestDouble(
            CompanyInterface::class
        );

        $this->timezone = $this->getTestDouble(
            TimezoneInterface::class
        );

        $this->language = $this->getTestDouble(
            LanguageInterface::class
        );

        $this->notificationTemplateContent = $this->getTestDouble(
            NotificationTemplateContentInterface::class
        );

        $this->getterProphecy(
            $this->callCsvReport,
            [
                'isNew' => true,
                'getBrand' => null,
                'getCallCsvScheduler' => $this->callCsvScheduler,
                'getSentTo' => 'mikel@somewhere.com',
                'getCompany' => $this->company,
                'getInDate' => new \DateTime('2015-01-01 01:01:01'),
                'getOutDate' => new \DateTime('2017-01-01 01:01:01')
            ],
            false
        );

        $this
            ->callCsvNotificationTemplateByCallCsvReport
            ->execute(
                Argument::type(CallCsvReportInterface::class)
            )
            ->willReturn(
                $this->notificationTemplateContent
            );

        $this->getterProphecy(
            $this->company,
            [
                'getDefaultTimezone' => $this->timezone,
                'getName' => 'Mikel',
                'getLanguage' => $this->language,
                'getCallCsvNotificationTemplate' => null,
            ],
            false
        );

        $this->timezone
            ->getTz()
            ->willReturn('UTC');

        $this->getterProphecy(
            $this->notificationTemplateContent,
            [
                'getFromName' => 'Name',
                'getFromAddress' => 'Address',
                'getBody' => 'Body',
                'getSubject' => 'Subject'
            ],
            false
        );

        $this->callCsvReportDto = new CallCsvReportDto();
        $this->callCsvReportDto
            ->setCsvPath('/tmp/file')
            ->getCsvBaseName('myCsv');

        $this
            ->entityTools
            ->entityToDto(
                Argument::type(CallCsvReportInterface::class)
            )
            ->willReturn($this->callCsvReportDto);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EmailSender::class);
    }

    public function it_sends_emails()
    {
        $this
            ->mailer
            ->send(
                Argument::type(Message::class)
            )
            ->shouldBeCalled();

        $this->execute($this->callCsvReport);
    }


    public function it_logs_errors_and_throws_domain_exception()
    {
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
            ->duringExecute($this->callCsvReport);
    }

    public function it_does_nothing_if_not_new(
        CallCsvReportInterface $callCsvReport
    ) {
        $this->callCsvReport
            ->isNew()
            ->willReturn(false)
            ->shouldBeCalled();

        $this->callCsvReport
            ->getCallCsvScheduler()
            ->willReturn(null)
            ->shouldNotBeCalled();

        $this->execute($this->callCsvReport);
    }

    public function it_does_nothing_with_empty_scheduler(
        CallCsvReportInterface $callCsvReport
    ) {
        $this->callCsvReport
            ->isNew()
            ->willReturn(true)
            ->shouldBeCalled();

        $this->callCsvReport
            ->getCallCsvScheduler()
            ->willReturn(null)
            ->shouldBeCalled();

        $this->callCsvReport
            ->getSentTo()
            ->shouldNotBeCalled();

        $this->execute($this->callCsvReport);
    }

    public function it_does_nothing_with_empty_target_email(
        CallCsvReportInterface $callCsvReport,
        CallCsvSchedulerInterface $callCsvScheduler
    ) {
        $this->callCsvReport
            ->isNew()
            ->willReturn(true)
            ->shouldBeCalled();


        $this->callCsvReport
            ->getCallCsvScheduler()
            ->willReturn(
                $this->callCsvScheduler
            )
            ->shouldBeCalled();


        $this->callCsvReport
            ->getSentTo()
            ->willReturn('')
            ->shouldBeCalled();


        $this->callCsvReport
            ->getCompany()
            ->shouldNotBeCalled();

        $this->execute(
            $this->callCsvReport
        );
    }
}
