# Hyperf OpenAI Client

[![Latest Test](https://github.com/friendsofhyperf/openai-client/workflows/tests/badge.svg)](https://github.com/friendsofhyperf/openai-client/actions)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/friendsofhyperf/openai-client.svg?style=flat-square)](https://packagist.org/packages/friendsofhyperf/openai-client)
[![Total Downloads](https://img.shields.io/packagist/dt/friendsofhyperf/openai-client.svg?style=flat-square)](https://packagist.org/packages/friendsofhyperf/openai-client)
[![GitHub license](https://img.shields.io/github/license/friendsofhyperf/openai-client)](https://github.com/friendsofhyperf/openai-client)

## Requires

> PHP 8.1+

## Installation

~~~bash
composer require friendsofhyperf/openai-client
~~~

publish

~~~bash
php bin/hyperf.php vendor:publish friendsofhyperf/openai-client
~~~

## Usage

~~~php
use OpenAI\Client;

$result = di(Client::class)->completions()->create([
    'model' => 'text-davinci-003',
    'prompt' => 'PHP is',
]);

echo $result['choices'][0]['text']; // an open-source, widely-used, server-side scripting language.
~~~
