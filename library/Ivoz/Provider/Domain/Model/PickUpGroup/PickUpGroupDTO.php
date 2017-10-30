<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class PickUpGroupDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @var array|null
     */
    private $relUsers = null;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'name' => $this->getName(),
            'id' => $this->getId(),
            'companyId' => $this->getCompanyId(),
            'relUsers' => $this->getRelUsers()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        if (!is_null($this->relUsers)) {
            $items = $this->getRelUsers();
            $this->relUsers = [];
            foreach ($items as $item) {
                $this->relUsers[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\PickUpRelUser\\PickUpRelUser',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->relUsers = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\PickUpRelUser\\PickUpRelUser',
            $this->relUsers
        );
    }

    /**
     * @param string $name
     *
     * @return PickUpGroupDTO
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param integer $id
     *
     * @return PickUpGroupDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $companyId
     *
     * @return PickUpGroupDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param array $relUsers
     *
     * @return PickUpGroupDTO
     */
    public function setRelUsers($relUsers)
    {
        $this->relUsers = $relUsers;

        return $this;
    }

    /**
     * @return array
     */
    public function getRelUsers()
    {
        return $this->relUsers;
    }
}


