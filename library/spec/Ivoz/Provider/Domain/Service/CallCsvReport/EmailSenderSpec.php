<?php

namespace spec\Ivoz\Provider\Domain\Service\CallCsvReport;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvScheduler;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Language\Language;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContent;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;
use Ivoz\Provider\Domain\Service\CallCsvReport\EmailSender;
use Ivoz\Provider\Domain\Service\NotificationTemplateContent\CallCsvNotificationTemplateByCallCsvReport;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class EmailSenderSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $callCsvNotificationTemplateByCallCsvReport;
    protected $mailer;
    protected $logger;

    protected $callCsvReport;

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

        $this->execute(
            $this->callCsvReport
        );
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

    public function it_does_nothing_if_not_new()
    {
        $this
            ->callCsvReport
            ->isNew()
            ->willReturn(false)
            ->shouldBeCalled();

        $this
            ->callCsvReport
            ->getCallCsvScheduler()
            ->willReturn(null)
            ->shouldNotBeCalled();

        $this->execute(
            $this->callCsvReport
        );
    }

    public function it_does_nothing_with_empty_scheduler()
    {
        $this
            ->callCsvReport
            ->getCallCsvScheduler()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->callCsvReport
            ->getSentTo()
            ->shouldNotBeCalled();

        $this->execute($this->callCsvReport);
    }

    public function it_does_nothing_with_empty_target_email()
    {
        $this
            ->callCsvReport
            ->getCallCsvScheduler()
            ->shouldBeCalled();

        $this
            ->callCsvReport
            ->getSentTo()
            ->willReturn('')
            ->shouldBeCalled();


        $this
            ->callCsvReport
            ->getCompany()
            ->shouldNotBeCalled();

        $this->execute(
            $this->callCsvReport
        );
    }

    protected function prepareExecution()
    {
        $callCsvScheduler = $this->getInstance(
            CallCsvScheduler::class
        );

        $language = $this->getInstance(
            Language::class
        );

        $timezone = $this->getInstance(
            Timezone::class,
            [
                'tz' => 'UTC'
            ]
        );

        $company = $this->getInstance(
            Company::class,
            [
                'defaultTimezone' => $timezone,
                'name' => 'Mikel',
                'language' => $language,
                'callCsvNotificationTemplate' => null,
            ]
        );

        $notificationTemplateContent = $this->getInstance(
            NotificationTemplateContent::class,
            [
                'fromName' => 'Name',
                'fromAddress' => 'Address',
                'body' => 'Body',
                'subject' => 'Subject'
            ]
        );

        $this->callCsvReport = $this->getTestDouble(
            CallCsvReportInterface::class
        );

        $this->getterProphecy(
            $this->callCsvReport,
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

        $this
            ->callCsvNotificationTemplateByCallCsvReport
            ->execute(
                Argument::type(CallCsvReportInterface::class)
            )
            ->willReturn(
                $notificationTemplateContent
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
