<?php

namespace Aptoma\Twig\Extension\MarkdownParser;

use Aptoma\Twig\Extension\MarkdownParserInterface;
use dflydev\markdown\MarkdownParser as VendorMarkdownParser;

/**
 * DflydevMarkdownParser.php
 *
 * Maps dflydev\markdown\MarkdownParser to Aptoma\Twig Markdown Extension
 * 
 * @author Joris Berthelot <joris@berthelot.tel>
 */
class DflydevMarkdownParser implements MarkdownParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($content)
    {
        return (new VendorMarkdownParser())->transformMarkdown($content);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'dflydev\markdown';
    }
}
