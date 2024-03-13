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
    protected $theme;

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

    public function __construct(
        string $brandName,
        string $theme,
        string $logo,
        string $color,
        string $title,
    ) {
        $this->name = $brandName;
        $this->theme = $theme;
        $this->logo = $logo;
        $this->color = $color;
        $this->title = $title;
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
    public function getTheme(): ?string
    {
        return $this->theme;
    }

    /**
     * @return WebTheme
     */
    public function setTheme(string $theme): WebTheme
    {
        $this->theme = $theme;
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
}
