<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * Class WebTheme
 * @package Model
 * @codeCoverageIgnore
 */
class WebTheme
{
    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $name;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $logo;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $color;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $title;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $productName;

    public function __construct(
        string $brandName,
        string $logo,
        string $color,
        string $title,
        string $productName,
    ) {
        $this->name = $brandName;
        $this->logo = $logo;
        $this->color = $color;
        $this->title = $title;
        $this->productName = $productName;
    }


    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return WebTheme
     */
    public function setName(string $name): WebTheme
    {
        $this->name = $name;
        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @return WebTheme
     */
    public function setLogo(string $logo): WebTheme
    {
        $this->logo = $logo;
        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }
}
