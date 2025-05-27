<?php

namespace Ivoz\Provider\Domain\Service\MaxUsageNotification;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

class SearchBrokenMaxDailyUsage implements CompanyLifecycleEventHandlerInterface
{
    public function __construct(
        private NotificationTemplateRepository $notificationTemplateRepository,
        private NotifyMaxDailyUsage $notifyMaxDailyUsage
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(CompanyInterface $company): void
    {
        $isNew = $company->isNew();
        if ($isNew) {
            return;
        }

        if (!$company->getMaxDailyUsageEmail()) {
            return;
        }

        if (!$company->hasChanged('currentDayUsage')) {
            return;
        }

        $currentDailyUsage = $company->getCurrentDayUsage();
        $maxDailyUsage = $company->getMaxDailyUsage();

        if ($currentDailyUsage < $maxDailyUsage) {
            return;
        }

        $prevCurrentDailyUsage = $company->getInitialValue('currentDayUsage');
        if ($prevCurrentDailyUsage >= $maxDailyUsage) {
            return;
        }

        $language = $company->getLanguage();

        $notificationTemplate = $this
            ->notificationTemplateRepository
            ->findMaxDailyUsageTemplateByCompany($company);

        $this
            ->notifyMaxDailyUsage
            ->send(
                $company,
                $notificationTemplate,
                $language
            );
    }
}
