<?php

namespace Aptoma\Twig\Extension;

use Aptoma\Twig\Extension\MarkdownParserInterface;
use Aptoma\Twig\TokenParser\MarkdownTokenParser;

/**
 * MarkdownExtension provides support for Markdown.
 *
 * @author Gunnar Lium <gunnar@aptoma.com>
 * @author Joris Berthelot <joris@berthelot.tel>
 */
class MarkdownExtension extends \Twig_Extension
{

    /**
     * @var MarkdownParserInterface $markdownParser
     */
    private $markdownParser;

    /**
     * @param MarkdownParserInterface $markdownParser The Markdown parser engine
     */
    public function __construct(MarkdownParserInterface $markdownParser)
    {
        $this->markdownParser = $markdownParser;
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
     * Transform Markdown content to HTML
     *
     * @param $content The Markdown content to be transformed
     * @return string The result of the Markdown parser transformation
     */
    public function parseMarkdown($content)
    {
        return $this->markdownParser->transform($content);
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return array(new MarkdownTokenParser($this->markdownParser));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'markdown';
    }
}
