<?php


namespace Agi;

use Agi\Agents\AgentInterface;
use Agi\Agents\DdiAgent;
use Agi\Agents\FaxAgent;
use Agi\Agents\FriendAgent;
use Agi\Agents\ResidentialAgent;
use Agi\Agents\RetailAgent;
use Agi\Agents\UserAgent;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Fax\Fax;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class ChannelInfo
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
     * @var AgentInterface
     */
    protected $origin;

    /**
     * @var AgentInterface
     */
    protected $caller;

    /**
     * ChannelInfo constructor.
     *
     * @param Wrapper $agi
     * @param EntityManagerInterface $em
     */
    public function __construct(
        Wrapper $agi,
        EntityManagerInterface $em
    ) {
        $this->agi = $agi;
        $this->em = $em;
    }

    /**
     * @param AgentInterface $agent
     */
    public function setChannelOrigin(AgentInterface $agent)
    {
        if ($agent->isEqual($this->origin)) {
            return;
        }

        $this->agi->setVariable("_ORIGIN", $agent);
    }

    /**
     * @param AgentInterface $agent
     */
    public function setChannelCaller(AgentInterface $agent)
    {
        if ($agent->isEqual($this->caller)) {
            return;
        }

        $this->agi->setVariable("_CALLER", $agent);
    }

    /**
     * @return AgentInterface
     */
    public function getChannelCaller()
    {
        if (is_null($this->caller)) {
            $this->caller = $this->getChannelData("CALLER");
        }

        return $this->caller;
    }

    /**
     * @return AgentInterface
     */
    public function getChannelOrigin()
    {
        if (is_null($this->origin)) {
            $this->origin = $this->getChannelData("ORIGIN");
        }

        return $this->origin;
    }

    /**
     * @param $datatype
     * @return AgentInterface
     */
    public function getChannelData($datatype)
    {
        $data = $this->agi->getVariable("${datatype}");

        if (empty($data)) {
            return null;
        }

        list ($type, $id) = explode('#', $data);

        switch ($type) {
            case "User":
                $repository = $this->em->getRepository(User::class);
                /** @var UserInterface $user */
                $user = $repository->find($id);
                return new UserAgent($this->agi, $user);
            case "Ddi":
                $repository = $this->em->getRepository(DDi::class);
                /** @var DdiInterface $ddi */
                $ddi = $repository->find($id);
                return new DdiAgent($this->agi, $ddi);
            case "Friend":
                $repository = $this->em->getRepository(Friend::class);
                /** @var FriendInterface $friend */
                $friend = $repository->find($id);
                return new FriendAgent($this->agi, $friend);
            case "Residential":
                $repository = $this->em->getRepository(ResidentialDevice::class);
                /** @var ResidentialDeviceInterface $residential */
                $residential = $repository->find($id);
                return new ResidentialAgent($this->agi, $residential);
            case "Retail":
                $repository = $this->em->getRepository(RetailAccount::class);
                /** @var RetailAccountInterface $retailAccount */
                $retailAccount = $repository->find($id);
                return new RetailAgent($this->agi, $retailAccount);
            case "Fax":
                $repository = $this->em->getRepository(Fax::class);
                /** @var FaxInterface $fax */
                $fax = $repository->find($id);
                return new FaxAgent($this->agi, $fax);
            default:
                return null;
        }
    }
}
