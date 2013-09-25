Twig Markdown Extension
=======================

[![Build Status](https://secure.travis-ci.org/aptoma/twig-markdown.png?branch=master)](http://travis-ci.org/aptoma/twig-markdown)

Twig Markdown extension provides a new filter and a tag to allow parsing of
content as Markdown in [Twig][1] templates.

This extension could be integrated with several Markdown parser as it provides an interface, which allows you to customize your Markdown parser.

### Supported parsers

 * [dflydev-markdown](https://github.com/dflydev/dflydev-markdown)
 * [michelf/php-markdown](https://github.com/michelf/php-markdown)


## Features

 * Filter support `{{ "# Heading Level 1"|markdown }}`
 * Tag support `{% markdown %}{% endmarkdown %}`


## Installation

Update your composer.json:

```json
// composer.json

{
    "require": {
        "aptoma/twig-markdown": "0.1.*"
    }
}
```

## Usage

### Tag and filter

It's assumed that you will use Composer to handle autoloading.

Add the extension to the twig environment:

```php

use Aptoma\Twig\Extension;
use Aptoma\Twig\Extension\MarkdownExtension;

// Uses dflydev\markdown parser
$parser = new MarkdownParser\DflydevMarkdownParser();

// Uses Michelf\Markdown parser (if you prefer)
$parser = new MarkdownParser\MichelfMarkdownParser();

$twig->addExtension(new MarkdownExtension($parser));
```
### Tag only

If you only want to use the `markdown-tag`, you can just add the token parser
to the Twig environment:

```php
use Aptoma\Twig\TokenParser\MarkdownTokenParser;

$twig->addTokenParser(new MarkdownTokenParser());
```

When used as a tag, any whitespace on the first line we be treated as padding and
removed from all lines. This allows you to mix HTML and Markdown in your templates,
without having all Markdown content being treated as code:

```php
<div>
    <h1 class="someClass">{{ title }}</h1>

    {% markdown %}
    This is a list that is indented to match the context around the markdown tag:

    * List item 1
    * List item 2

    The following block will be treated as code, as it is indented more than the
    surrounding content:

        $code = "good";

    {% endmarkdown %}

</div>
```

## Tests

The test suite uses PHPUnit:

    $ phpunit

## Adding a Markdown parser

To add your own Markdown parser, just create a class in the `Aptoma/Twig/Extension/MarkdownParser` folder and name it according to your vendor ID.
Your class MUST implement the interface `Aptoma\Twig\Extension\MarkdownParserInterface.php` to be accepted in the extension.

## License

Twig Markdown Extension is licensed under the MIT license.

[1]: http://twig.sensiolabs.org
