<?php

namespace Aptoma\Twig\TokenParser;

use Aptoma\Twig\Node\MarkdownNode;

/**
 * @author Gunnar Lium <gunnar@aptoma.com>
 * @author Joris Berthelot <joris@berthelot.tel>
 */
class MarkdownTokenParser extends \Twig_TokenParser
{
    /**
     * {@inheritdoc}
     */
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();

        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideMarkdownEnd'), true);
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return new MarkdownNode($body, $lineno, $this->getTag());
    }

    /**
     * Decide if current token marks end of Markdown block.
     *
     * @param \Twig_Token $token
     * @return bool
     */
    public function decideMarkdownEnd(\Twig_Token $token)
    {
        return $token->test('endmarkdown');
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return 'markdown';
    }
}
