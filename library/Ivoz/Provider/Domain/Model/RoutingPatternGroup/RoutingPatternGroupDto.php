<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto;

class RoutingPatternGroupDto extends RoutingPatternGroupDtoAbstract
{
    public const CONTEXT_WITH_PATTERNS = 'withPatterns';

    public const CONTEXTS_WITH_PATTERNS = [
        self::CONTEXT_COLLECTION,
        self::CONTEXT_WITH_PATTERNS,
        self::CONTEXT_DETAILED
    ];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Binded routing patterns"
     * )
     */
    private $patternIds = [];

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'name' => 'name',
                'description' => 'description',
                'id' => 'id'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        if (in_array($context, self::CONTEXTS_WITH_PATTERNS, true)) {
            $response['patternIds'] = 'patternIds';
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['brandId']);
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    public function normalize(string $context, string $role = ''): array
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if (in_array($context, self::CONTEXTS_WITH_PATTERNS, true)) {
            $response['patternIds'] = $this->patternIds;
        }

        return $response;
    }

    /**
     * @param int[] $patternIds
     *
     * @return void
     */
    public function setPatternIds(array $patternIds): void
    {
        $this->patternIds = $patternIds;

        $relPatterns = [];
        foreach ($patternIds as $id) {
            $dto = new RoutingPatternGroupsRelPatternDto();
            $dto->setRoutingPatternId($id);
            $relPatterns[] = $dto;
        }

        $this->setRelPatterns($relPatterns);
    }
}
