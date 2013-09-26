<?php

namespace Aptoma\Twig\Extension\MarkdownEngine;

use Aptoma\Twig\Extension\MarkdownEngineInterface;
use Michelf\Markdown;

/**
 * MichelfMarkdownEngine.php
 *
 * Maps Michelf\Markdown to Aptoma\Twig Markdown Extension
 *
 * @author Joris Berthelot <joris@berthelot.tel>
 */
class MichelfMarkdownEngine implements MarkdownEngineInterface
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
