<?php

namespace Aptoma\Twig\Extension\MarkdownEngine;

use Aptoma\Twig\Extension\MarkdownEngineInterface;
use dflydev\markdown\MarkdownParser;

/**
 * DflydevMarkdownParser.php
 *
 * Maps dflydev\markdown\MarkdownParser to Aptoma\Twig Markdown Extension
 * 
 * @author Joris Berthelot <joris@berthelot.tel>
 */
class DflydevMarkdownEngine implements MarkdownEngineInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($content)
    {
        $engine = new MarkdownParser();
        
        return $engine->transformMarkdown($content);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'dflydev\markdown';
    }
}
