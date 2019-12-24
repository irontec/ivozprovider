<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionDto;

class IvrDto extends IvrDtoAbstract
{
    const CONTEXT_WITH_EXCLUDED_EXTENSIONS = 'withExcludedExtensions';

    const CONTEXTS_WITH_EXCLUDED_EXTENSIONS = [
        self::CONTEXT_WITH_EXCLUDED_EXTENSIONS,
        self::CONTEXT_DETAILED
    ];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Excluded extensions"
     * )
     */
    protected $excludedExtensionIds = [];

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name'
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());

        if (in_array($context, self::CONTEXTS_WITH_EXCLUDED_EXTENSIONS, true)) {
            $response['excludedExtensionIds'] = 'excludedExtensionIds';
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        return $response;
    }

    public function normalize(string $context, string $role = '')
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if (in_array($context, self::CONTEXTS_WITH_EXCLUDED_EXTENSIONS, true)) {
            $response['excludedExtensionIds'] = $this->excludedExtensionIds;
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = '')
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    /**
     * @param int[] $extensionIds
     */
    public function setExcludedExtensionIds(array $extensionIds)
    {
        $this->excludedExtensionIds = $extensionIds;

        $relExtensions = [];
        foreach ($extensionIds as $id) {
            $dto = new IvrExcludedExtensionDto();
            $dto->setExtensionId($id);
            $relExtensions[] = $dto;
        }

        $this->setExcludedExtensions($relExtensions);
    }
}
