<?php

namespace Aptoma\Twig\Extension;

/**
 * MarkdownParserInterface.php
 *
 * Provide software interface to maps various Markdown parsers
 *
 * @author Joris Berthelot <joris@berthelot.tel>
 */
interface MarkdownParserInterface
{
    /**
     * Transforms the given markdown data in HTML
     *
     * @param $content Markdown data
     * @return string
     */
    public function transform($content);

    /**
     * Return Markdown parser vendor ID
     *
     * @return string
     */
    public function getName();
}
