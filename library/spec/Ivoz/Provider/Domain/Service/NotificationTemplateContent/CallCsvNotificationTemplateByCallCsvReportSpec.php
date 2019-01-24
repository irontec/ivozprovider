<?php

namespace spec\Ivoz\Provider\Domain\Service\NotificationTemplateContent;

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

class CallCsvNotificationTemplateByCallCsvReportSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var NotificationTemplateRepository
     */
    protected $notificationTemplateRepository;

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
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var NotificationTemplateInterface
     */
    protected $callCsvNotificationTemplate;

    /**
     * @var NotificationTemplateInterface
     */
    protected $genericCallCsvNotificationTemplate;

    /**
     * @var NotificationTemplateContentInterface
     */
    protected $notificationTemplateContent;

    public function let(
        NotificationTemplateRepository $notificationTemplateRepository
    ) {
        $this->notificationTemplateRepository = $notificationTemplateRepository;

        $this->beConstructedWith(
            $this->notificationTemplateRepository
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

        $this->language = $this->getTestDouble(
            LanguageInterface::class
        );

        $this->callCsvNotificationTemplate = $this->getTestDouble(
            NotificationTemplateInterface::class
        );

        $this->genericCallCsvNotificationTemplate = $this->getTestDouble(
            NotificationTemplateInterface::class
        );

        $this->notificationTemplateContent = $this->getTestDouble(
            NotificationTemplateContentInterface::class
        );

        $this
            ->notificationTemplateRepository
            ->findGenericCallCsvTemplate()
            ->willReturn($this->genericCallCsvNotificationTemplate);

        $this
            ->genericCallCsvNotificationTemplate
            ->getContentsByLanguage(
                Argument::type(LanguageInterface::class)
            )
            ->willReturn($this->notificationTemplateContent);

        $this->getterProphecy(
            $this->callCsvReport,
            [
                'getBrand' => null,
                'getCallCsvScheduler' => $this->callCsvScheduler,
                'getCompany' => $this->company
            ],
            false
        );

        $this->callCsvNotificationTemplate
            ->getContentsByLanguage(
                Argument::type(LanguageInterface::class)
            )
            ->willReturn(
                $this->notificationTemplateContent
            );

        $this->getterProphecy(
            $this->company,
            [
                'getName' => 'Mikel',
                'getLanguage' => $this->language,
                'getCallCsvNotificationTemplate' => null,
            ],
            false
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CallCsvNotificationTemplateByCallCsvReport::class);
    }

    public function it_prioritizes_company_notification_template()
    {
        $this
            ->company
            ->getCallCsvNotificationTemplate()
            ->willReturn($this->callCsvNotificationTemplate)
            ->shouldBeCalled();


        $this
            ->notificationTemplateRepository
            ->findGenericCallCsvTemplate()
            ->shouldNotBeCalled();

        $this->execute($this->callCsvReport);
    }

    public function it_searchs_for_scheduler_notification_template_when_no_company()
    {
        $brand = $this->getTestDouble(
            BrandInterface::class
        );

        $this
            ->callCsvReport
            ->getCompany()
            ->willReturn(null);

        $this
            ->callCsvReport
            ->getBrand()
            ->willReturn(
                $brand
            );

        $this->getterProphecy(
            $brand,
            [
                'getLanguage' => $this->language
            ],
            true
        );

        $this
            ->callCsvScheduler
            ->getCallCsvNotificationTemplate()
            ->willReturn($this->callCsvNotificationTemplate)
            ->shouldBeCalled();

        $this->execute($this->callCsvReport);
    }

    public function it_uses_generic_notification_template_as_fallback()
    {
        $this
            ->company
            ->getCallCsvNotificationTemplate()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->notificationTemplateRepository
            ->findGenericCallCsvTemplate()
            ->willReturn($this->genericCallCsvNotificationTemplate)
            ->shouldBeCalled();

        $this->execute($this->callCsvReport);
    }
}
