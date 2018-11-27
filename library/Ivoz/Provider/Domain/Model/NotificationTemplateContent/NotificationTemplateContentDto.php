<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

class NotificationTemplateContentDto extends NotificationTemplateContentDtoAbstract
{

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'fromName' => 'fromName',
                'fromAddress' => 'fromAddress'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
