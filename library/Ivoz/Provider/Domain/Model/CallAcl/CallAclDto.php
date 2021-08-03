<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListDto;
use Ivoz\Api\Core\Annotation\AttributeDefinition;

class CallAclDto extends CallAclDtoAbstract
{
    const CONTEXT_WITH_MATCHLIST = 'withMatchListIds';

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="MatchList ids"
     * )
     */
    protected $matchListIds = [];

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'defaultPolicy' => 'defaultPolicy'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());

            if ($context === self::CONTEXT_WITH_MATCHLIST) {
                $response['matchListIds'] = 'matchListIds';
            }
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

        if ($context === self::CONTEXT_WITH_MATCHLIST) {
            $response['matchListIds'] = $this->matchListIds;
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = '')
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
        }

        if ($context === self::CONTEXT_WITH_MATCHLIST) {
            $contextProperties['matchListIds'] = 'matchListIds';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    /**
     * @param int[] $ids
     */
    public function setMatchListIds(array $ids)
    {
        $this->matchListIds = $ids;

        $matchListDtos = [];
        foreach ($ids as $id) {
            $matchListDtos[] = new CallAclRelMatchListDto($id);
            ;
        }

        $this->setRelMatchLists($matchListDtos);
    }
}
