<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Ast\Domain\Model\PsAor\PsAor;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainDTO;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

/**
 * Class UpdateByCompany
 * @package Ivoz\Provider\Domain\Service\Domain
 * @lifecycle post_persist
 * @todo this could be partially merged with UpdateByBrand
 */
class UpdateByCompany implements CompanyLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var DomainRepository
     */
    protected $domainRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        DomainRepository $domainRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->domainRepository = $domainRepository;
    }

    public function execute(CompanyInterface $entity, $isNew)
    {
        $id = $entity->getId();

        /**
         * @var DomainInterface $domain
         */
        $domain = $this->domainRepository->findOneBy([
            'company' => $id,
            'pointsTo' => 'proxyusers'
        ]);

        // If domain field is filled, look for brand domains or create a new one
        if ($domain) {
            $this->updateTerminalsDomain($entity, $domain);
            $this->updateFriendsDomain($entity, $domain);
        }

        // If domain field is filled, look for brand domains or create a new one
        $domainDto = is_null($domain)
            ? Domain::createDTO()
            : $domain->toDto();

        $name = $entity->getDomainUsers();

        /**
         * @var DomainDTO $domainDto
         */
        $domainDto
            ->setDomain($name)
            ->setScope('brand')
            ->setPointsTo('proxyusers')
            ->setCompanyId($id)
            ->setDescription($entity->getName() . " proxyusers domain");

        $this->entityPersister->persistDto($domainDto, $domain);
    }

    private function updateTerminalsDomain(Company $company, Domain $domain)
    {
        $terminals = $company->getTerminals();

        /**
         * @var Terminal $terminal
         */
        foreach ($terminals as $terminal) {

            $terminal->setDomain($domain->getDomain());
            $endpoint = $terminal->getAstPsEndpoint();
            $aor = $endpoint->getPsAor();

            /**
             * @todo Can we take for granted that aor exists?
             */
            $aor->setContact(
                $terminal->getContact()
            );
        }
    }

    private function updateFriendsDomain(Company $company, Domain $domain)
    {
        $friends = $company->getFriends();

        /**
         * @var Friend $friend
         */
        foreach ($friends as $friend) {

            $friend->setDomain($domain->getDomain());

            /**
             * @todo ensure this method exists
             * @var PsEndpoint $endpoint
             */
            $endpoint = $friend->getAstPsEndpoint();

            /**
             * @var PsAor $aor
             */
            $aor = $endpoint->getPsAor();
            $aor->setContact(
                /**
                 * @todo ensure this method exists
                 */
                $friend->getContact()
            );
        }
    }
}
