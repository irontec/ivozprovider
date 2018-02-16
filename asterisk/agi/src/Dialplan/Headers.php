<?php

namespace Dialplan;

use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Helpers\EndpointResolver;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use RouteHandlerAbstract;


class Headers extends RouteHandlerAbstract
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var EndpointResolver
     */
    protected $endpointResolver;

    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em,
        EndpointResolver $endpointResolver
    )
    {
        $this->agi = $agi;
        $this->em = $em;
        $this->endpointResolver = $endpointResolver;
    }

    /**
     * @brief Add SIP Headers for proxies
     */
    public function process()
    {
        /** @var CompanyRepository $companyRepository */
        $companyRepository = $this->em->getRepository(Company::class);

        // Get company from channel variables
        $companyId = $this->agi->getVariable("COMPANYID");

        /** @var CompanyInterface $company */
        $company = $companyRepository->find($companyId);

        // Add headers for Friendly Kamailio  Proxy;-))
        $this->agi->setSIPHeader("X-Call-Id",            $this->agi->getVariable("CALL_ID"));
        $this->agi->setSIPHeader("X-Info-BrandId",       $company->getBrand()->getId());
        $this->agi->setSIPHeader("X-Info-CompanyId",     $company->getId());
        $this->agi->setSIPHeader("X-Info-CompanyName",   $company->getName());
        $this->agi->setSIPHeader("X-Info-MediaRelaySet", $company->getMediaRelaySets()->getId());

        // Get Calle data, take if from called endpoint
        $endpoint = $this->endpointResolver->getEndpointFromName($this->agi->getEndpoint());
        if (!empty($endpoint)) {
            $terminal = $endpoint->getTerminal();
            if (!is_null($terminal)) {
                /** @var UserInterface $user */
                $user = $terminal->getUser();
                $this->agi->setSIPHeader("X-Info-Callee", $user->getExtensionNumber());
                $this->agi->setSIPHeader("X-Info-MaxCalls", $user->getMaxCalls());
            }
            $friend = $endpoint->getFriend();
            if (!is_null($friend)) {
                $exten = $this->agi->getExtension();
                $this->agi->setSIPHeader("X-Info-Callee", $exten);
                $this->agi->setSIPHeader("X-Info-Friend", $friend->getRequestURI($exten));
                $this->agi->setSIPHeader("X-Info-MaxCalls", 0);
            }
            $retail = $endpoint->getRetailAccount();
            if (!is_null($retail)) {
                $exten = $this->agi->getExtension();
                $this->agi->setSIPHeader("X-Info-Callee", $exten);
                $this->agi->setSIPHeader("X-Info-Retail", $retail->getRequestURI($exten));
                $this->agi->setSIPHeader("X-Info-MaxCalls", 0);

            }

            // Set on-demand recording header (only for proxyusers)
            if ($company->getOnDemandRecord()) {
                $this->agi->setSIPHeader("X-Info-RecordCode", $company->getOnDemandRecordCode());
                $this->agi->setVariable("FEATUREMAP(automixmon)", $company->getOnDemandRecordDTMFs());
            }

        } else {
            $this->agi->setSIPHeader("X-Info-CompanyDomain", $company->getDomain()->getDomain());
            $this->agi->setSIPHeader("X-Info-MaxCalls",  $company->getExternalMaxCalls());

            // Set special headers for Fax outgoing calls
            if ($this->agi->getVariable("FAXFILE_ID")) {
                $this->agi->setSIPHeader("X-Info-Special", "fax");
            }
        }

        // Set Special header for Forwarding
        if ($this->agi->getRedirecting('from-tag')) {
            $this->agi->setSIPHeader("X-Info-ForwardExt", $this->agi->getRedirecting('from-tag'));
        }

        // Set recording header
        if ($this->agi->getVariable("RECORD")) {
            $this->agi->setSIPHeader("X-Info-Record", $this->agi->getVariable("RECORD"));
        }

        // Request intra DDI bounce
        if ($this->agi->getVariable("BOUNCEME")) {
            $this->agi->setSIPHeader("X-Info-BounceMe", $this->agi->getVariable("BOUNCEME"));
        }

        // Set pickups group on outgoing channels
        if ($this->agi->getVariable("CHANNEL(namedpickupgroup)")) {
            $this->agi->setVariable("CHANNEL(namedcallgroup)", $this->agi->getVariable("CHANNEL(namedpickupgroup)"));
        }
    }

}