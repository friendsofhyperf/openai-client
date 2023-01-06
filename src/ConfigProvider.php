<?php

declare(strict_types=1);
/**
 * This file is part of openai-client.
 *
 * @link     https://github.com/friendsofhyperf/openai-client
 * @document https://github.com/friendsofhyperf/openai-client/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */
namespace FriendsOfHyperf\OpenAi;

use OpenAI\Client;

class ConfigProvider
{
    public function __invoke()
    {
        defined('BASE_PATH') || define('BASE_PATH', dirname(__DIR__, 2));

        return [
            'dependencies' => [
                Client::class => ClientFactory::class,
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config file for OpenAI.',
                    'source' => __DIR__ . '/../publish/openai.php',
                    'destination' => BASE_PATH . '/config/autoload/openai.php',
                ],
            ],
        ];
    }
}
