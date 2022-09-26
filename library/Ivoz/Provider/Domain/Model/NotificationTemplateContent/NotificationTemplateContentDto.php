<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

class NotificationTemplateContentDto extends NotificationTemplateContentDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'fromName' => 'fromName',
                'fromAddress' => 'fromAddress',
                'languageId' => 'language',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
