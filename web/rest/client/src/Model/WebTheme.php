<?php

namespace Model;

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

    public function __construct($brandName, $theme, $logo)
    {
        $this->name = $brandName;
        $this->theme = $theme;
        $this->logo = $logo;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return WebTheme
     */
    public function setName(string $name): WebTheme
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string | null
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     * @return WebTheme
     */
    public function setTheme(string $theme): WebTheme
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * @return string | null
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return WebTheme
     */
    public function setLogo(string $logo): WebTheme
    {
        $this->logo = $logo;
        return $this;
    }
}
