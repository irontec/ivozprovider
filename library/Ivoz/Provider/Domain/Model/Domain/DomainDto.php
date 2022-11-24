<?php

namespace Ivoz\Provider\Domain\Model\Domain;

class DomainDto extends DomainDtoAbstract
{
    private string $brandName = '';
    private string $companyName = '';

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'domain' => 'domain',
                'pointsTo' => 'pointsTo',
                'brandName' => 'brandName',
                'companyName' => 'companyName'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

    public function setBrandName(string $name): void
    {
        $this->brandName = $name;
    }

    public function setCompanyName(string $name): void
    {
        $this->companyName = $name;
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = parent::toArray($hideSensitiveData);
        $response['brandName'] = $this->brandName;
        $response['companyName'] = $this->companyName;

        return $response;
    }
}
