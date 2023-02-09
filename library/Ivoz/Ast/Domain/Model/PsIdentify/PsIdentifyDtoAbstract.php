<?php

namespace Ivoz\Ast\Domain\Model\PsIdentify;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto;

/**
* PsIdentifyDtoAbstract
* @codeCoverageIgnore
*/
abstract class PsIdentifyDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $sorceryId = null;

    /**
     * @var string|null
     */
    private $endpoint = null;

    /**
     * @var string|null
     */
    private $match = null;

    /**
     * @var string|null
     */
    private $matchHeader = null;

    /**
     * @var string|null
     */
    private $srvLookups = 'false';

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var TerminalDto | null
     */
    private $terminal = null;

    /**
     * @var FriendDto | null
     */
    private $friend = null;

    /**
     * @var ResidentialDeviceDto | null
     */
    private $residentialDevice = null;

    /**
     * @var RetailAccountDto | null
     */
    private $retailAccount = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'sorceryId' => 'sorceryId',
            'endpoint' => 'endpoint',
            'match' => 'match',
            'matchHeader' => 'matchHeader',
            'srvLookups' => 'srvLookups',
            'id' => 'id',
            'terminalId' => 'terminal',
            'friendId' => 'friend',
            'residentialDeviceId' => 'residentialDevice',
            'retailAccountId' => 'retailAccount'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'sorceryId' => $this->getSorceryId(),
            'endpoint' => $this->getEndpoint(),
            'match' => $this->getMatch(),
            'matchHeader' => $this->getMatchHeader(),
            'srvLookups' => $this->getSrvLookups(),
            'id' => $this->getId(),
            'terminal' => $this->getTerminal(),
            'friend' => $this->getFriend(),
            'residentialDevice' => $this->getResidentialDevice(),
            'retailAccount' => $this->getRetailAccount()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setSorceryId(string $sorceryId): static
    {
        $this->sorceryId = $sorceryId;

        return $this;
    }

    public function getSorceryId(): ?string
    {
        return $this->sorceryId;
    }

    public function setEndpoint(?string $endpoint): static
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    public function setMatch(?string $match): static
    {
        $this->match = $match;

        return $this;
    }

    public function getMatch(): ?string
    {
        return $this->match;
    }

    public function setMatchHeader(?string $matchHeader): static
    {
        $this->matchHeader = $matchHeader;

        return $this;
    }

    public function getMatchHeader(): ?string
    {
        return $this->matchHeader;
    }

    public function setSrvLookups(string $srvLookups): static
    {
        $this->srvLookups = $srvLookups;

        return $this;
    }

    public function getSrvLookups(): ?string
    {
        return $this->srvLookups;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTerminal(?TerminalDto $terminal): static
    {
        $this->terminal = $terminal;

        return $this;
    }

    public function getTerminal(): ?TerminalDto
    {
        return $this->terminal;
    }

    public function setTerminalId($id): static
    {
        $value = !is_null($id)
            ? new TerminalDto($id)
            : null;

        return $this->setTerminal($value);
    }

    public function getTerminalId()
    {
        if ($dto = $this->getTerminal()) {
            return $dto->getId();
        }

        return null;
    }

    public function setFriend(?FriendDto $friend): static
    {
        $this->friend = $friend;

        return $this;
    }

    public function getFriend(): ?FriendDto
    {
        return $this->friend;
    }

    public function setFriendId($id): static
    {
        $value = !is_null($id)
            ? new FriendDto($id)
            : null;

        return $this->setFriend($value);
    }

    public function getFriendId()
    {
        if ($dto = $this->getFriend()) {
            return $dto->getId();
        }

        return null;
    }

    public function setResidentialDevice(?ResidentialDeviceDto $residentialDevice): static
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceDto
    {
        return $this->residentialDevice;
    }

    public function setResidentialDeviceId($id): static
    {
        $value = !is_null($id)
            ? new ResidentialDeviceDto($id)
            : null;

        return $this->setResidentialDevice($value);
    }

    public function getResidentialDeviceId()
    {
        if ($dto = $this->getResidentialDevice()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRetailAccount(?RetailAccountDto $retailAccount): static
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    public function getRetailAccount(): ?RetailAccountDto
    {
        return $this->retailAccount;
    }

    public function setRetailAccountId($id): static
    {
        $value = !is_null($id)
            ? new RetailAccountDto($id)
            : null;

        return $this->setRetailAccount($value);
    }

    public function getRetailAccountId()
    {
        if ($dto = $this->getRetailAccount()) {
            return $dto->getId();
        }

        return null;
    }
}
