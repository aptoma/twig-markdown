<?php

namespace Aptoma\Twig\Extension\MarkdownEngine;

use Aptoma\Twig\Extension\MarkdownEngineInterface;
use Parsedown;

/**
 * ParsedownEngine.php
 *
 * Maps erusev/parsedown to Aptoma\Twig Markdown Extension
 *
 * @author Sébastien Lourseau <https://github.com/SebLours>
 */
class ParsedownEngine implements MarkdownEngineInterface
{
    /**
     * @var Parsedown
     */
    protected $engine;

    /**
     * @param string|null $instanceName
     */
    public function __construct($instanceName = null)
    {
        $this->engine = Parsedown::instance($instanceName);
    }

    /**
     * {@inheritdoc}
     */
    public function transform($content)
    {
        return $this->engine->parse($content);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'erusev/parsedown';
    }
    
    /**
     * Turn on/off escaping within the generated HTML. Should be
     * turned on for untrusted user input.
     *
     * @param bool $bool Flag to set Safe Mode to
     */
    public function setSafeMode($bool)
    {
        $this->engine->setSafeMode($bool === true);
    }
    
    /**
     * Turn on/off escaping HTML in trusted user input.
     *
     * @param bool $bool Flag to set markup escaped to
     */
    public function setMarkupEscaped($bool)
    {
        $this->engine->setMarkupEscaped($bool === true);
    }
}
