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

When used as a tag, the indentation level of the first line sets the default indentation level for the rest of the tag content.
From this indentation level, all same indentation or outdented levels text will be transformed as regular text.

This feature allows you to write your Markdown content at any indentation level without caring of Markdown internal transformation:

```php
<div>
    <h1 class="someClass">{{ title }}</h1>

    {% markdown %}
    This is a list that is indented to match the context around the markdown tag:

    * List item 1
    * List item 2
        * Sub List Item
            * Sub Sub List Item

    The following block will be transformed as code, as it is indented more than the
    surrounding content:

        $code = "good";

    {% endmarkdown %}

</div>
```

## Installation

Update your composer.json:

```json
// composer.json

{
    "require": {
        "aptoma/twig-markdown": "0.2.*"
    }
}
```

## Usage

### Twig Extension

The Twig extension provides the `markdown` tag and filter support.

Assumed that you are using [composer](http://getcomposer.org) autoloading.

Adds the extension to the Twig environment:

```php

use Aptoma\Twig\Extension\MarkdownExtension;
use Aptoma\Twig\Extension\MarkdownParser;

// Uses dflydev\markdown parser
$parser = new MarkdownParser\DflydevMarkdownParser();

// Uses Michelf\Markdown parser (if you prefer)
$parser = new MarkdownParser\MichelfMarkdownParser();

$twig->addExtension(new MarkdownExtension($parser));
```
### Twig Token Parser

The Twig token parser provides the `markdown` tag only!

```php
use Aptoma\Twig\Extension\MarkdownParser;
use Aptoma\Twig\TokenParser\MarkdownTokenParser;

// Uses dflydev\markdown parser
$parser = new MarkdownParser\DflydevMarkdownParser();

// Uses Michelf\Markdown parser (if you prefer)
$parser = new MarkdownParser\MichelfMarkdownParser();

$twig->addTokenParser(new MarkdownTokenParser($parser));
```

## Tests

The test suite uses PHPUnit:

    $ phpunit

## Adding a Markdown parser engine

To add your own Markdown parser engine, just create a class in the `Aptoma/Twig/Extension/MarkdownParser` folder and name it according to your vendor ID.
Your class MUST implement the interface `Aptoma\Twig\Extension\MarkdownParserInterface.php`.

## License

Twig Markdown Extension is licensed under the MIT license.

[1]: http://twig.sensiolabs.org
