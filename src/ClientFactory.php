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

use FriendsOfHyperf\OpenAi\Exception\ApiKeyIsMissing;
use OpenAI;
use Psr\Container\ContainerInterface;

class ClientFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $apiKey = config('openai.api_key');
        $organization = config('openai.organization');

        if (! is_string($apiKey) || ($organization !== null && ! is_string($organization))) {
            throw ApiKeyIsMissing::create();
        }

        return OpenAI::client($apiKey, $organization);
    }
}
