<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyInterface;
use Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* FriendInterface
*/
interface FriendInterface extends LoggableEntityInterface
{
    public const TRANSPORT_UDP = 'udp';

    public const TRANSPORT_TCP = 'tcp';

    public const TRANSPORT_TLS = 'tls';

    public const DIRECTMEDIAMETHOD_INVITE = 'invite';

    public const DIRECTMEDIAMETHOD_UPDATE = 'update';

    public const CALLERIDUPDATEHEADER_PAI = 'pai';

    public const CALLERIDUPDATEHEADER_RPID = 'rpid';

    public const UPDATECALLERID_YES = 'yes';

    public const UPDATECALLERID_NO = 'no';

    public const DIRECTCONNECTIVITY_YES = 'yes';

    public const DIRECTCONNECTIVITY_NO = 'no';

    public const DIRECTCONNECTIVITY_INTERVPBX = 'intervpbx';

    public const DDIIN_YES = 'yes';

    public const DDIIN_NO = 'no';

    public const T38PASSTHROUGH_YES = 'yes';

    public const T38PASSTHROUGH_NO = 'no';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @return bool
     */
    public function isInterPbxConnectivity(): bool;

    /**
     * @return bool
     */
    public function isDirectConnectivity(): bool;

    /**
     * @return bool
     */
    public function isRegisterConnectivity(): bool;

    /**
     * @param string $number
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getInterCompanyExtension($number);

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setIp
     * @deprecated this method will be protected
     */
    public function setIp(?string $ip = null): static;

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setPort
     * @deprecated this method will be protected
     */
    public function setPort(?int $port = null): static;

    /**
     * {@inheritDoc}
     * @see FriendAbstract::setPassword
     * @deprecated this method will be protected
     */
    public function setPassword(?string $password = null): static;

    /**
     * @return string
     */
    public function getContact(): string;

    /**
     * @return string
     */
    public function getSorcery(): string;

    /**
     * @param string $exten
     * @return bool
     */
    public function checkExtension($exten);

    /**
     * @param string $exten
     * @return bool canCall
     */
    public function isAllowedToCall($exten);

    public function getLanguageCode(): string;

    /**
     * Get Friend outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface|null
     */
    public function getOutgoingDdi(): ?DdiInterface;

    public static function createDto(string|int|null $id = null): FriendDto;

    /**
     * @internal use EntityTools instead
     * @param null|FriendInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FriendDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FriendDto;

    public function getName(): string;

    public function getDescription(): string;

    public function getTransport(): ?string;

    public function getIp(): ?string;

    public function getPort(): ?int;

    public function getPassword(): ?string;

    public function getPriority(): int;

    public function getDisallow(): string;

    public function getAllow(): string;

    public function getDirectMediaMethod(): string;

    public function getCalleridUpdateHeader(): string;

    public function getUpdateCallerid(): string;

    public function getFromUser(): ?string;

    public function getFromDomain(): ?string;

    public function getDirectConnectivity(): string;

    public function getDdiIn(): string;

    public function getT38Passthrough(): string;

    public function getAlwaysApplyTransformations(): bool;

    public function getRtpEncryption(): bool;

    public function getMultiContact(): bool;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function setDomain(?DomainInterface $domain = null): static;

    public function getDomain(): ?DomainInterface;

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    public function getCallAcl(): ?CallAclInterface;

    public function getLanguage(): ?LanguageInterface;

    public function getInterCompany(): ?CompanyInterface;

    public function isInitialized(): bool;

    public function setPsEndpoint(PsEndpointInterface $psEndpoint): static;

    public function getPsEndpoint(): ?PsEndpointInterface;

    public function setPsIdentify(PsIdentifyInterface $psIdentify): static;

    public function getPsIdentify(): ?PsIdentifyInterface;

    public function addPattern(FriendsPatternInterface $pattern): FriendInterface;

    public function removePattern(FriendsPatternInterface $pattern): FriendInterface;

    public function replacePatterns(ArrayCollection $patterns): FriendInterface;

    public function getPatterns(?Criteria $criteria = null): array;
}
