<?php

namespace Ivoz\Provider\Domain\Service\MaxUsageNotification;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Model\Mailer\Message;
use Ivoz\Core\Domain\Service\MailerClientInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotification;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotificationDto;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotificationRepository;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;

class NotifyMaxDailyUsage
{
    public function __construct(
        private MaxUsageNotificationRepository $maxUsageNotificationRepository,
        private EntityTools $entityTools,
        private MailerClientInterface $mailer
    ) {
    }

    /**
     * @return void
     */
    public function send(
        CompanyInterface $company,
        NotificationTemplateInterface $notificationTemplate
    ) {
        /** @var MaxUsageNotification | null $maxUsageNotification */
        $maxUsageNotification = $this
            ->maxUsageNotificationRepository
            ->findByCompany($company);

        /** @var MaxUsageNotificationDto $maxUsageNotificationDto */
        $maxUsageNotificationDto = !is_null($maxUsageNotification)
            ? $this->entityTools->entityToDto($maxUsageNotification)
            : new MaxUsageNotificationDto();

        $language = $company->getLanguage();
        if (!$language) {
            $language = $company
                ->getBrand()
                ->getLanguage();
        }

        $notificationTemplateContent = $notificationTemplate->getContentsByLanguage($language);

        $subject = $this->parseNotificationSubject(
            $notificationTemplateContent->getSubject(),
            $company->getName()
        );

        $bodyType = $notificationTemplateContent->getBodyType();

        $body = $this->parseNotificationBody(
            $notificationTemplateContent->getBody(),
            $company->getName(),
            $company->getMaxDailyUsage()
        );

        /** @todo async email send */
        $email = new Message();
        $email
            ->setSubject($subject)
            ->setBody($body, $bodyType)
            ->setFromAddress(
                $notificationTemplateContent->getFromAddress()
            )
            ->setFromName(
                $notificationTemplateContent->getFromName()
            )
            ->setToAddress(
                $company->getMaxDailyUsageEmail()
            );

        $this->mailer->send($email);

        $maxUsageNotificationDto
            ->setToAddress(
                $company->getMaxDailyUsageEmail()
            )
            ->setThreshold(
                $company->getMaxDailyUsage()
            )
            ->setCompanyId(
                $company->getId()
            )
            ->setNotificationTemplateId(
                $notificationTemplate->getId()
            )
            ->setLastSent(
                new \DateTime(
                    'now',
                    new \DateTimeZone('UTC')
                )
            );

        $this
            ->entityTools
            ->persistDto(
                $maxUsageNotificationDto,
                $maxUsageNotification,
                false
            );
    }

    private function parseNotificationSubject(string $content, string $name): string
    {
        $substitution = array(
            '${MAXDAILYUSAGE_COMPANY}' => $name,
        );

        return str_replace(array_keys($substitution), array_values($substitution), $content);
    }

    private function parseNotificationBody(string $content, string $name, float $amount): string
    {
        $substitution = array(
            '${MAXDAILYUSAGE_COMPANY}' => $name,
            '${MAXDAILYUSAGE_AMOUNT}' => $amount,
        );

        return str_replace(array_keys($substitution), array_values($substitution), $content);
    }
}
