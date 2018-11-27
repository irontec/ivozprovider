<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

class NotificationTemplateDto extends NotificationTemplateDtoAbstract
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
                'name' => 'name',
                'type' => 'type',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
