<?php

namespace Aptoma\Twig\Extension\MarkdownEngine;

use Aptoma\Twig\Extension\MarkdownEngineInterface;
use Michelf\MarkdownExtra;

/**
 * MichelfMarkdownEngine.php
 *
 * Maps Michelf\MarkdownExtra to Aptoma\Twig Markdown Extension
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
        $engine = new MarkdownExtra();
        foreach (get_object_vars($this) as $property => $value) {
            if (property_exists($engine, $property)) {
                $engine->{$property} = $value;
            }
        }
        return $engine->transform($content);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Michelf\Markdown';
    }
}
