<?php

namespace Ivoz\Provider\Domain\Model\Language;

class LanguageDto extends LanguageDtoAbstract
{
    /**
     * @deprecated this will be remove in ivozprovider 3.0
     * @param string $language
     * @return mixed
     */
    public function getName(string $language)
    {
        $msg = 'The %s method is deprecated as of 2.1 and will be removed in 3.0.';
        @trigger_error(
            sprintf($msg, __METHOD__),
            E_USER_DEPRECATED
        );

        return $this->{'getName' . ucfirst($language)}();
    }

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'iden' => 'iden',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
