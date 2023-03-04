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
use Hyperf\Guzzle\ClientFactory as GuzzleClientFactory;
use OpenAI\Client;
use OpenAI\Transporters\HttpTransporter;
use OpenAI\ValueObjects\ApiKey;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
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

        $apiKey = ApiKey::from($apiKey);
        $baseUri = BaseUri::from('api.openai.com/v1');
        $headers = Headers::withAuthorization($apiKey);

        if ($organization !== null) {
            $headers = $headers->withOrganization($organization);
        }

        $client = $container->get(GuzzleClientFactory::class)->create();
        $transporter = new HttpTransporter($client, $baseUri, $headers);

        return new Client($transporter);
    }
}
