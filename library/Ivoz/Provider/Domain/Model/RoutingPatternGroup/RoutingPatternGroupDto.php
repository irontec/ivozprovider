<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto;

class RoutingPatternGroupDto extends RoutingPatternGroupDtoAbstract
{
    const CONTEXT_WITH_PATTERNS = 'withPatterns';

    const CONTEXTS_WITH_PATTERNS = [
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
    protected $patternIds = [];

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'name' => 'name',
                'description' => 'description',
                'id' => 'id'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());

            if (in_array($context, self::CONTEXTS_WITH_PATTERNS, true)) {
                $response['patternIds'] = 'patternIds';
            }
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['brandId']);
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = '')
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

    public function normalize(string $context, string $role = '')
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
     */
    public function setPatternIds(array $patternIds)
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
