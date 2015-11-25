<?php

namespace Aptoma\Twig\Extension\MarkdownEngine;

use Aptoma\Twig\Extension\MarkdownExtensionTest;
use Github\Client;

require_once(__DIR__ . '/../MarkdownExtensionTest.php');

/**
 * Class GitHubMarkdownEngineTest
 *
 * @author Lukas W <lukaswhl@gmail.com>
 */
class GitHubMarkdownEngineTest extends MarkdownExtensionTest
{
    public function getParseMarkdownTests()
    {
        return array(
            array('{{ "# Main Title"|markdown }}', '<h1>Main Title</h1>'),
            array('{{ content|markdown }}', '<h1>Main Title</h1>', array('content' => '# Main Title')),
            // Check if GFM is working
            array('{{ "@aptoma"|markdown }}',
                  '<p><a href="https://github.com/aptoma" class="user-mention">@aptoma</a></p>'),
        );
    }

    protected function getEngine()
    {
        $client = new Client();

        if ($client->rateLimit()->getCoreLimit() < 1) {
            $this->markTestSkipped('The github API rate limit is reached, so this engine cannot be tested.');
        }

        return new GitHubMarkdownEngine();
    }
}
