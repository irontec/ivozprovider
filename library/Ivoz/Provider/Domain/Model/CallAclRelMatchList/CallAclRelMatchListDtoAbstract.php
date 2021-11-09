<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelMatchList;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclDto;
use Ivoz\Provider\Domain\Model\MatchList\MatchListDto;

/**
* CallAclRelMatchListDtoAbstract
* @codeCoverageIgnore
*/
abstract class CallAclRelMatchListDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var string
     */
    private $policy;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CallAclDto | null
     */
    private $callAcl;

    /**
     * @var MatchListDto | null
     */
    private $matchList;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'priority' => 'priority',
            'policy' => 'policy',
            'id' => 'id',
            'callAclId' => 'callAcl',
            'matchListId' => 'matchList'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'priority' => $this->getPriority(),
            'policy' => $this->getPolicy(),
            'id' => $this->getId(),
            'callAcl' => $this->getCallAcl(),
            'matchList' => $this->getMatchList()
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

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPolicy(string $policy): static
    {
        $this->policy = $policy;

        return $this;
    }

    public function getPolicy(): ?string
    {
        return $this->policy;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCallAcl(?CallAclDto $callAcl): static
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    public function getCallAcl(): ?CallAclDto
    {
        return $this->callAcl;
    }

    public function setCallAclId($id): static
    {
        $value = !is_null($id)
            ? new CallAclDto($id)
            : null;

        return $this->setCallAcl($value);
    }

    public function getCallAclId()
    {
        if ($dto = $this->getCallAcl()) {
            return $dto->getId();
        }

        return null;
    }

    public function setMatchList(?MatchListDto $matchList): static
    {
        $this->matchList = $matchList;

        return $this;
    }

    public function getMatchList(): ?MatchListDto
    {
        return $this->matchList;
    }

    public function setMatchListId($id): static
    {
        $value = !is_null($id)
            ? new MatchListDto($id)
            : null;

        return $this->setMatchList($value);
    }

    public function getMatchListId()
    {
        if ($dto = $this->getMatchList()) {
            return $dto->getId();
        }

        return null;
    }
}
