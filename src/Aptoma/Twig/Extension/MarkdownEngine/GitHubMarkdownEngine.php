<?php
namespace Aptoma\Twig\Extension\MarkdownEngine;

use Aptoma\Twig\Extension\MarkdownEngineInterface;

/**
 * GithubMarkdownEngine.php
 *
 * Maps GitHub's Markdown engine API to Aptoma\Twig Markdown Extension using
 * KnpLabs\php-github-api.
 *
 * @author Lukas W <lukaswhl@gmail.com>
 */
class GitHubMarkdownEngine implements MarkdownEngineInterface
{
    /**
     * Constructor
     *
     * @param string $context_repo The repository context. Pass a GitHub repo
     *        such as 'aptoma/twig-markdown' to render e.g. issues #23 in the
     *        context of the repo.
     * @param bool $gfm Whether to use GitHub's Flavored Markdown or the
     *        standard markdown. Default is true.
     * @param string $cache_dir Location on disk where rendered documents should
     *        be stored.
     * @param \Github\Client $client Client object to use. A new Github\Client()
     *        object is constructed automatically if $client is null.
     */
    public function __construct($context_repo = null, $gfm = true, $cache_dir = '/tmp/github-markdown-cache', $client=null)
    {
        $this->repo = $context_repo;
        $this->mode = $gfm ? 'gfm' : 'markdown';
        $this->cache_dir = rtrim($cache_dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        if (!is_dir($this->cache_dir)) {
            @mkdir($this->cache_dir, 0777, true);
        }

        if ($client === null) {
            $client = new \Github\Client();
        }
        $this->api = $client->api('markdown');
    }

    /**
     * {@inheritdoc}
     */
    public function transform($content)
    {
        $cache_file = $this->getCachePath($content);
        if (file_exists($cache_file)) {
            return file_get_contents($cache_file);;
        }

        $response = $this->api->render($content, $this->mode, $this->repo);
        file_put_contents($cache_file, $response);
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'KnpLabs\php-github-api';
    }

    private function getCachePath($content)
    {
        return $this->cache_dir . md5($content) . '_' . $this->mode. '_' . str_replace('/', '.', $this->repo);
    }

    private $api;
    private $cache_dir;
    private $repo;
    private $mode;
}
