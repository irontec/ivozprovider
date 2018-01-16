<?php


namespace Agi;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Fax\Fax;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
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
     * @var EntityInterface
     */
    protected $origin;

    /**
     * @var EntityInterface
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
    )
    {
        $this->agi = $agi;
        $this->em = $em;
    }

    /**
     * @param EntityInterface $origin
     */
    public function setChannelOrigin(EntityInterface $origin)
    {
        if (get_class($origin) == get_class($this->origin)
            && ($origin->getId() == $this->origin->getId()))
        {
            return;
        }

        $this->setChannelData("ORIGIN", $origin);
    }

    /**
     * @param EntityInterface $caller
     */
    public function setChannelCaller(EntityInterface $caller)
    {
        if (get_class($caller) == get_class($this->$caller)
            && ($caller->getId() == $this->$caller->getId()))
        {
            return;
        }

        $this->setChannelData("CALLER", $caller);
    }

    /**
     * @param string $datatype
     * @param EntityInterface $data
     */
    public function setChannelData(string $datatype, EntityInterface $data)
    {
        $id = $data->getId();
        $type = "Unknown";

        if ($data instanceof UserInterface) {
            $type = "User";
        } else if ($data instanceof DdiInterface) {
            $type = "Ddi";
        } else if ($data instanceof FriendInterface) {
            $type = "Friend";
        } else if ($data instanceof RetailAccountInterface) {
            $type = "RetailAccount";
        } else if ($data instanceof FaxInterface) {
            $type = "Fax";
        }

        $this->agi->setVariable("_${datatype}", $type . '#' . $id);
    }

    /**
     * @return null|object
     */
    public function getChannelCaller()
    {
        if (is_null($this->caller)) {
            $this->caller = $this->getChannelData("CALLER");
        }

        return $this->caller;
    }

    /**
     * @return null|object
     */
    public function getChannelOrigin()
    {
        if (is_null($this->caller)) {
            $this->origin = $this->getChannelData("ORIGIN");
        }

        return $this->origin;
    }

    /**
     * @param $datatype
     * @return null|object
     */
    public function getChannelData($datatype)
    {
        $data = $this->agi->getVariable("${datatype}");
        list ($type, $id) = explode('#', $data);

        switch ($type) {
            case "User":
                $repository = $this->em->getRepository(User::class);
                break;
            case "Ddi":
                $repository = $this->em->getRepository(DDi::class);
                break;
            case "Friend":
                $repository = $this->em->getRepository(Friend::class);
                break;
            case "Retail":
                $repository = $this->em->getRepository(RetailAccount::class);
                break;
            case "Fax":
                $repository = $this->em->getRepository(Fax::class);
                break;
            default:
                return null;
        }

        return $repository->find($id);
    }

}