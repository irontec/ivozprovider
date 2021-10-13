<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class RouteLockDto extends RouteLockDtoAbstract
{
    /**
     * @var string
     * @AttributeDefinition(
     *     type="string",
     *     description="Close extension",
     *     writable=false
     * )
     */
    protected $closeExtension = '';

    /**
     * @var string
     * @AttributeDefinition(
     *     type="string",
     *     description="Open extension",
     *     writable=false
     * )
     */
    protected $openExtension = '';

    /**
     * @var string
     * @AttributeDefinition(
     *     type="string",
     *     description="Toggle extension",
     *     writable=false
     * )
     */
    protected $toggleExtension = '';

    public const CALCULATED_READ_ONLY_PROPS = [
        'closeExtension' => 'closeExtension',
        'openExtension' => 'openExtension',
        'toggleExtension' => 'toggleExtension',
    ];

    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $collectionProps = [
                'name' => 'name',
                'description' => 'description',
                'open' => 'open',
                'id' => 'id',
            ];

            return $collectionProps + self::CALCULATED_READ_ONLY_PROPS;
        }

        $response = parent::getPropertyMap(...func_get_args());

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        return $response + self::CALCULATED_READ_ONLY_PROPS;
    }

    public function denormalize(array $data, string $context, string $role = '')
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
        }

        foreach (self::CALCULATED_READ_ONLY_PROPS as $readOnlyFld) {
            if (!isset($data[$readOnlyFld])) {
                continue;
            }

            unset($data[$readOnlyFld]);
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    public function toArray($hideSensitiveData = false)
    {
        $response = parent::toArray($hideSensitiveData);

        $response = $response + [
            'closeExtension' => $this->getCloseExtension(),
            'openExtension' => $this->getOpenExtension(),
            'toggleExtension' => $this->getToggleExtension(),
        ];

        return $response;
    }

    public function getCloseExtension(): string
    {
        return $this->closeExtension;
    }

    public function setCloseExtension(string $closeExtension): RouteLockDto
    {
        $this->closeExtension = $closeExtension;
        return $this;
    }

    public function getOpenExtension(): string
    {
        return $this->openExtension;
    }

    public function setOpenExtension(string $openExtension): RouteLockDto
    {
        $this->openExtension = $openExtension;
        return $this;
    }

    public function getToggleExtension(): string
    {
        return $this->toggleExtension;
    }

    public function setToggleExtension(string $toggleExtension): RouteLockDto
    {
        $this->toggleExtension = $toggleExtension;
        return $this;
    }
}
