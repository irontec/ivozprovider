<?php

namespace Dialplan;

use Agi\Action\DdiAction;
use Agi\Agents\DdiAgent;
use Agi\ChannelInfo;
use Agi\Webhook\WebhookEventPublisher;
use Agi\Wrapper;
use Assert\Assertion;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use RouteHandlerAbstract;

class Trunks extends RouteHandlerAbstract
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var ChannelInfo
     */
    protected $channelInfo;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var DDIAction
     */
    protected $ddiAction;

    /**
     * @var WebhookEventPublisher
     */
    protected $webhookEventPublisher;

    /**
     * Trunks constructor.
     *
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param EntityManagerInterface $em
     * @param DDIAction $ddiAction
     * @param WebhookEventPublisher $webhookEventPublisher
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        EntityManagerInterface $em,
        DDIAction $ddiAction,
        WebhookEventPublisher $webhookEventPublisher
    ) {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->em = $em;
        $this->ddiAction = $ddiAction;
        $this->webhookEventPublisher = $webhookEventPublisher;
    }

    /**
     * Incomming from from external numbers
     *
     * @throws \InvalidArgumentException
     */
    public function process()
    {
        // Get Dialed number
        $exten = $this->agi->getExtension();

        /** @var \Ivoz\Provider\Domain\Model\Ddi\DdiRepository $ddiRepository */
        $ddiRepository = $this->em->getRepository(Ddi::class);

        /** @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi */
        $ddi = $ddiRepository->findOneByDdiE164($exten);

        // Check if incoming DDI is for us
        Assertion::notNull(
            $ddi,
            sprintf("DDI %s not found in database.", $exten)
        );

        // Mark this call as external
        $this->agi->setVariable("__CALL_TYPE", "external");

        // Remove any Diversion header from external calls
        if ($this->agi->getRedirecting('count')) {
            $this->agi->setRedirecting('count', 0);
        }

        // Set Outgoing Channels X-CID header variable
        $this->agi->setVariable("__CALL_ID", $this->agi->getCallId());

        // Get company MusicClass: company, Generic or default
        /** @var CompanyInterface $company */
        $company = $ddi->getCompany();
        $brand = $company->getBrand();
        $this->agi->setVariable("__COMPANYID", $company->getId());
        $this->agi->setVariable("__COMPANYTYPE", $company->getType());
        $this->agi->setVariable("__BRANDID", $brand->getId());
        $this->agi->setVariable("__ONDEMANDCODE", $company->getOnDemandRecordDTMFs());
        $this->agi->setVariable("CHANNEL(musicclass)", $company->getMusicClass());
        $this->agi->setVariable("CHANNEL(language)", $ddi->getLanguageCode());

        // Set DDI as the caller
        $this->channelInfo->setChannelCaller(new DdiAgent($this->agi, $ddi));

        // Set DDI context for webhooks
        $this->agi->setVariable("__DDIID", $ddi->getId());
        $this->agi->setVariable("__DDIE164", $ddi->getDdiE164());

        // Publish call start event to webhooks
        $this->webhookEventPublisher->publish('start');

        // Process this DDI
        $this->ddiAction
            ->setDDI($ddi)
            ->process();
    }
}
