<?php

namespace Ivoz\Kam\Domain\Model\Trusted;

/**
 * Trusted
 */
class Trusted extends TrustedAbstract implements TrustedInterface
{
    use TrustedTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
        // Set tag with companyId value
        $company = $this->getCompany();
        if ($company) {
            $this->setTag((string) $company->getId());
        }
    }

}

