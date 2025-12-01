<?php

namespace Ivoz\Provider\Domain\Model\MatchList;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface;

/**
 * MatchList
 */
class MatchList extends MatchListAbstract implements MatchListInterface
{
    use MatchListTrait;

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
     * Check if the given number matches the list rules
     *
     * @param string $number in E164 form
     * @return bool true if number matches, false otherwise
     */
    public function numberMatches($number)
    {
        // Get patterns
        $patterns = $this->getPatterns();

        /**
         * @var MatchListPatternInterface $pattern
         */
        foreach ($patterns as $pattern) {
            switch ($pattern->getType()) {
                case 'number':
                    if ($pattern->getNumberE164() === $number) {
                        return true;
                    }
                    break;
                case 'regexp':
                    $regexp = $pattern->getRegExp();
                    $match = preg_match('/' . $regexp . '/', $number);
                    if ($match) {
                        return true;
                    }
                    break;
            }
        }

        return false;
    }

    protected function setCompany(CompanyInterface $company = null): static
    {
        if (is_null($company)) {
            return parent::setCompany(null);
        }

        $companyType = $company->getType();
        $isValidCompanyType =
            $companyType === CompanyInterface::TYPE_VPBX ||
            $companyType === CompanyInterface::TYPE_RESIDENTIAL;

        if (!$isValidCompanyType) {
            throw new \DomainException('MatchList can only be associated with vpbx or residential companies');
        }

        return parent::setCompany($company);
    }
}
