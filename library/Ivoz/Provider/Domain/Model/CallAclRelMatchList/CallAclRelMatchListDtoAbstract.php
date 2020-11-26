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

    /**
     * @param int $priority | null
     *
     * @return static
     */
    public function setPriority(?int $priority = null): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param string $policy | null
     *
     * @return static
     */
    public function setPolicy(?string $policy = null): self
    {
        $this->policy = $policy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPolicy(): ?string
    {
        return $this->policy;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param CallAclDto | null
     *
     * @return static
     */
    public function setCallAcl(?CallAclDto $callAcl = null): self
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * @return CallAclDto | null
     */
    public function getCallAcl(): ?CallAclDto
    {
        return $this->callAcl;
    }

    /**
     * @return static
     */
    public function setCallAclId($id): self
    {
        $value = !is_null($id)
            ? new CallAclDto($id)
            : null;

        return $this->setCallAcl($value);
    }

    /**
     * @return mixed | null
     */
    public function getCallAclId()
    {
        if ($dto = $this->getCallAcl()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param MatchListDto | null
     *
     * @return static
     */
    public function setMatchList(?MatchListDto $matchList = null): self
    {
        $this->matchList = $matchList;

        return $this;
    }

    /**
     * @return MatchListDto | null
     */
    public function getMatchList(): ?MatchListDto
    {
        return $this->matchList;
    }

    /**
     * @return static
     */
    public function setMatchListId($id): self
    {
        $value = !is_null($id)
            ? new MatchListDto($id)
            : null;

        return $this->setMatchList($value);
    }

    /**
     * @return mixed | null
     */
    public function getMatchListId()
    {
        if ($dto = $this->getMatchList()) {
            return $dto->getId();
        }

        return null;
    }

}
