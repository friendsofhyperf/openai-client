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

use Hyperf\Contract\ConfigInterface;
use Hyperf\Guzzle\ClientFactory as GuzzleClientFactory;
use OpenAI\Client;
use OpenAI\Transporters\HttpTransporter;
use OpenAI\ValueObjects\ApiToken;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
use Psr\Container\ContainerInterface;

class ClientFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get(ConfigInterface::class);
        $clientFactory = $container->get(GuzzleClientFactory::class);

        $apiToken = $config->get('openai.api_key');
        $organization = $config->get('openai.organization');

        $apiToken = ApiToken::from($apiToken);
        $baseUri = BaseUri::from('api.openai.com/v1');
        $headers = Headers::withAuthorization($apiToken);

        if ($organization !== null) {
            $headers = $headers->withOrganization($organization);
        }

        $client = $clientFactory->create();

        $transporter = new HttpTransporter($client, $baseUri, $headers);

        return new Client($transporter);
    }
}
