<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
 * CallAcl
 */
class CallAcl extends CallAclAbstract implements CallAclInterface
{
    use CallAclTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }


    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string $dst
     * @return bool
     */
    public function dstIsCallable($dst)
    {
        $defaultPolicy = $this->getDefaultPolicy();

        $criteria = Criteria
            ::create()
            ->orderBy(['priority' => Criteria::ASC]);

        /**
         * @var CallAclRelMatchListInterface[] $aclRelMatchLists
         */
        $aclRelMatchLists = $this->getRelMatchLists($criteria);

        foreach ($aclRelMatchLists as $aclRelMatchList) {
            $policy = $aclRelMatchList->getPolicy();
            $matchList = $aclRelMatchList->getMatchList();

            if ($matchList->numberMatches($dst)) {
                return 'allow' === $policy;
            }
        }

        return 'allow' === $defaultPolicy;
    }

    protected function setCompany(CompanyInterface $company): static
    {
        if ($company->getType() !== CompanyInterface::TYPE_VPBX) {
            throw new \DomainException('CallAcl can only be associated with vpbx companies');
        }

        return parent::setCompany($company);
    }
}
