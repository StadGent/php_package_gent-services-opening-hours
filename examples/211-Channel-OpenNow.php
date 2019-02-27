<?php

/**
 * StadGent\Services\OpeningHours Examples.
 *
 * Example how to get the Open Now status object by the Service and Channel ID.
 */

use GuzzleHttp\Client as GuzzleClient;
use StadGent\Services\OpeningHours\Configuration\Configuration;
use StadGent\Services\OpeningHours\Client\Client;
use StadGent\Services\OpeningHours\ChannelOpeningHours;

require_once __DIR__ . '/bootstrap.php';

example_print_header('Example how to get the Open Now status object by the Service and Channel ID.');

example_print_step('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiKey);

example_print_step('Create the Guzzle client.');
$guzzleClient = new GuzzleClient(['base_uri' => $configuration->getUri()]);

example_print_step('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

example_print_step('Get the ChannelService.');
$service = ChannelOpeningHours::create($client);

example_print_step('Get the Open Now status by the Services & Channel ID');
example_print();

try {
    $openNow = $service->getOpenNow($service_id, $channel_id);
    example_sprintf(' Id      : %d', $openNow->getChannelId());
    example_sprintf(' Label   : %s', $openNow->getChannelLabel());
    example_sprintf(' Is Open : %d', (int)$openNow->isOpen());
} catch (\StadGent\Services\OpeningHours\Exception\ServiceNotFoundException $e) {
    example_sprintf(' ! No Service found for Service ID : %d', $service_id);
} catch (\StadGent\Services\OpeningHours\Exception\ChannelNotFoundException $e) {
    example_sprintf(' ! No Channel found for Channel ID : %d', $channel_id);
} catch (\Exception $e) {
    example_sprintf(' ! Error : %s', $e->getMessage());
}

example_print_footer();
