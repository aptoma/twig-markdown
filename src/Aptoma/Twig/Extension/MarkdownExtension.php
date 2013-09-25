<?php

namespace Aptoma\Twig\Extension;

use Aptoma\Twig\Extension\MarkdownParserInterface;
use Aptoma\Twig\TokenParser\MarkdownTokenParser;

/**
 * MarkdownExtension provides support for Markdown.
 *
 * @author Gunnar Lium <gunnar@aptoma.com>
 */
class MarkdownExtension extends \Twig_Extension
{

    /**
     * @var MarkdownParserInterface $parser
     */
    private $parser;

    public function __construct(MarkdownParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            'markdown' => new \Twig_Filter_Method(
                $this,
                'parseMarkdown',
                array('is_safe' => array('html'))
            )
        );
    }

    /**
     * Transform Markdown text to HTML
     *
     * @param $text
     * @return string
     */
    public function parseMarkdown($text)
    {
        return $this->parser->transform($text);
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return array(new MarkdownTokenParser());
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'markdown';
    }
}
