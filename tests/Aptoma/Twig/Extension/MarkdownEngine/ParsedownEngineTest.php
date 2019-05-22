<?php

namespace Aptoma\Twig\Extension\MarkdownEngine;

use Aptoma\Twig\Extension\MarkdownExtension;
use Aptoma\Twig\Extension\MarkdownExtensionTest;

// Require parent class if not autoloaded
if (!class_exists('\Aptoma\Twig\Extension\MarkdownExtensionTest')) {
    require_once(__DIR__ . '/../MarkdownExtensionTest.php');
}

/**
 * Class ParsedownEngineTest
 *
 * @author Sébastien Lourseau <https://github.com/SebLours>
 */
class ParsedownEngineTest extends MarkdownExtensionTest
{
    public function getParseMarkdownTests()
    {
        return array(
            array('{{ "# Main Title"|markdown }}', '<h1>Main Title</h1>'),
            array('{{ content|markdown }}', '<h1>Main Title</h1>', array('content' => '# Main Title')),
            array('{% markdown %}{{ content }}{% endmarkdown %}', '<h1>Main Title</h1>', array('content' => '# Main Title'))
        );
    }

    protected function getEngine()
    {
        return new ParsedownEngine();
    }

    public function testSafeMode()
    {
        $engine = $this->getEngine();
        $loader = new \Twig\Loader\ArrayLoader(array('index' => '{{ "_Test_<em>Test</em>[xss](javascript:alert%281%29)"|markdown }}'));
        $twig = new \Twig\Environment($loader, array('debug' => true, 'cache' => false));
        $twig->addExtension(new MarkdownExtension($engine));

        $this->assertEquals('<p><em>Test</em><em>Test</em><a href="javascript:alert%281%29">xss</a></p>', $twig->load('index')->render());

        $engine->setSafeMode(true);
        $this->assertEquals('<p><em>Test</em>&lt;em&gt;Test&lt;/em&gt;<a href="javascript%3Aalert%281%29">xss</a></p>', $twig->load('index')->render());
        $engine->setSafeMode(false);
    }

    public function testMarkupEscape()
    {
        $engine = $this->getEngine();
        $loader = new \Twig\Loader\ArrayLoader(array('index' => '{{ "_Test_<em>Test</em>[xss](javascript:alert%281%29)"|markdown }}'));
        $twig = new \Twig\Environment($loader, array('debug' => true, 'cache' => false));
        $twig->addExtension(new MarkdownExtension($engine));

        $this->assertEquals('<p><em>Test</em><em>Test</em><a href="javascript:alert%281%29">xss</a></p>', $twig->load('index')->render());

        $engine->setMarkupEscaped(true);
        $this->assertEquals('<p><em>Test</em>&lt;em&gt;Test&lt;/em&gt;<a href="javascript:alert%281%29">xss</a></p>', $twig->load('index')->render());        
        $engine->setMarkupEscaped(false);
    }
}
