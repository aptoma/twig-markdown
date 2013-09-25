<?php

namespace Aptoma\Twig\Extension\MarkdownParser;

use Aptoma\Twig\Extension\MarkdownParserInterface;
use Michelf\Markdown;

/**
 * MichelfMarkdownParser.php
 *
 * Maps Michelf\Markdown to Aptoma\Twig Markdown Extension
 *
 * @author Joris Berthelot <joris@berthelot.tel>
 */
class MichelfMarkdownParser implements MarkdownParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($content)
    {
        return Markdown::defaultTransform($content);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Michelf\Markdown';
    }
}
