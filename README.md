Twig Markdown Extension
=======================

[![Build Status](https://secure.travis-ci.org/aptoma/twig-markdown.png?branch=master)](http://travis-ci.org/aptoma/twig-markdown)

Twig Markdown extension provides a new filter and a tag to allow parsing of
content as Markdown in [Twig][1] templates.

This extension provides an integration with [dflydev-markdown](https://github.com/dflydev/dflydev-markdown)
for the actual parsing of Markdown.

## Installation

Update your composer.json:

```
// composer.json

{
    "require": {
        "aptoma/twig-markdown": "0.1.*"
    }
}
```

## Usage

It's assumed that you will use Composer to handle autoloading.

Add the extension to the twig environment:

```php
$parser = new \dflydev\markdown\MarkdownParser();

$twig->addExtension(new \Aptoma\Twig\Extension\MarkdownExtension($parser));
```

Use filter or tag in your templates:

```twig
// Filter
{{ "#Title"|markdown }}

// becomes

<h1>Title</h1>

// Tag
{% markdown %}
#Title

Paragraph of text.

    $block = 'code';
{% endmarkdown %}

// becomes

<h1>Title</h1>

<p>Paragraph of text</p>

<pre><code>$block = 'code';</pre></code>
```

If you only want to use the `markdown`-tag, you can also just add the token parser
to the Twig environment:

```php
$twig->addTokenParser(new \Aptoma\Twig\TokenParser\MarkdownTokenParser());
```

When used as a tag, any whitespace on the first line we be treated as padding and
removed form all lines. This allows you to mix HTML and Markdown in your templates,
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

## License

Twig Markdown Extension is licensed under the MIT license.

[1]: http://twig.sensiolabs.org/
