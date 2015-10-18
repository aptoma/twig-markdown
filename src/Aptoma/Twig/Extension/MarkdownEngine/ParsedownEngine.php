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
     * Parsedown instance name.
     */
    const INSTANCE_NAME = 'atoma';

    /**
     * @var Parsedown
     */
    protected $engine;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->engine = Parsedown::instance(self::INSTANCE_NAME);
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
}
