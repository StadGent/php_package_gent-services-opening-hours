<?php

/**
 * StadGent\Services\OpeningHours Examples.
 *
 * Example how to get the OpeningHours object for a single day by the Service and Channel ID.
 */

use GuzzleHttp\Client as GuzzleClient;
use StadGent\Services\OpeningHours\Configuration\Configuration;
use StadGent\Services\OpeningHours\Client\Client;
use StadGent\Services\OpeningHours\ChannelOpeningHours;

require_once __DIR__ . '/bootstrap.php';

example_print_header(
    'Example how to get the OpeningHours object for a single day'
    . PHP_EOL
    . ' by the Service and Channel ID.'
);

example_print_step('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiKey);

example_print_step('Create the Guzzle client.');
$guzzleClient = new GuzzleClient(['base_uri' => $configuration->getUri()]);

example_print_step('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

example_print_step('Get the ChannelService.');
$service = ChannelOpeningHours::create($client);

example_print_step('Get the OpeningHours by the Services, Channel ID & date');
example_print();

try {
    $openingHours = $service->getDay($service_id, $channel_id, $openinghours_day_date);
    example_sprintf(' Id      : %d', $openingHours->getChannelId());
    example_sprintf(' Label   : %s', $openingHours->getChannelLabel());
    example_print();

    /* @var $day \StadGent\Services\OpeningHours\Value\Day */
    $days = $openingHours->getDays()->getIterator();
    $day = reset($days);
    example_sprintf(' Date    : %s', $day->getDate()->format('d/m/Y'));
    example_sprintf(' Is open : %d', (int) $day->isOpen());
    example_print(' Hours:');

    /* @var $hours \StadGent\Services\OpeningHours\Value\Hours */
    foreach ($day->getHours() as $hours) {
        example_sprintf('   %s > %s', $hours->getFromHour(), $hours->getUntilHour());
    }
    example_print();
} catch (\StadGent\Services\OpeningHours\Exception\ServiceNotFoundException $e) {
    example_sprintf(' ! No Service found for Service ID : %d', $service_id);
} catch (\StadGent\Services\OpeningHours\Exception\ChannelNotFoundException $e) {
    example_sprintf(' ! No Channel found for Channel ID : %d', $channel_id);
} catch (\Exception $e) {
    example_sprintf(' ! Error : %s', $e->getMessage());
}

example_print_footer();
