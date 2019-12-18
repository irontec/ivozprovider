<?php

namespace Ivoz\Kam\Domain\Model\Trusted;

use Ivoz\Core\Domain\Assert\Assertion;

/**
 * Trusted
 */
class Trusted extends TrustedAbstract implements TrustedInterface
{
    use TrustedTrait;

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

        $this->setProto('any');
    }

    public function setSrcIp($srcIp = null)
    {
        try {
            Assertion::ip($srcIp);
        } catch (\Exception $e) {
            throw new \DomainException('Invalid IP address, discarding value.', 70000, $e);
        }

        return parent::setSrcIp($srcIp);
    }
}
