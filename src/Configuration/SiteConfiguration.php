<?php

namespace GamingEngine\Core\Configuration;

/**
 * @property-read bool $darkMode
 * @property-read string $defaultTheme
 * @property-read string $titleFormat
 * @property-read int $minimumAge
 * @property-read string $name
 */
class SiteConfiguration extends BaseConfiguration
{
    /**
     * Should the site have "dark mode" enabled?
     *
     * @var bool
     */
    public bool $darkMode;

    /**
     * The default theme that the site will use
     *
     * @var string
     */
    public string $defaultTheme;

    /**
     * The format for how the title of the page is displayed.
     * {title} receives the page "chunk"
     * {site} receives the site name
     *
     * @var string
     */
    public string $titleFormat;

    /**
     * What is the youngest that a member can be?
     *
     * @var int
     */
    public int $minimumAge;

    /**
     * The name of the site
     *
     * @var string
     */
    public string $name;

    /**
     * The URL to the logo
     *
     * @var string
     */
    public string $logoUrl;
}
