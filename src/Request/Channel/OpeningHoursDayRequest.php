<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use DigipolisGent\API\Client\Request\AbstractRequest;
use StadGent\Services\OpeningHours\Uri\Channel\OpeningHoursDayUri;

/**
 * Get the OpeningHours for a single day as JSON.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class OpeningHoursDayRequest extends AbstractRequest
{
    /**
     * Get the OpeningHours for a single day by the Service & Channel ID.
     *
     * @param int $serviceId
     *   The Service ID to get the channel for.
     * @param int $channelId
     *   The Channel ID to get.
     * @param string $date
     *   The day (date in Y-m-d format) to get the opening hours for.
     */
    public function __construct($serviceId, $channelId, $date)
    {
        $uri = new OpeningHoursDayUri($serviceId, $channelId, $date);
        parent::__construct($uri);
    }
}
