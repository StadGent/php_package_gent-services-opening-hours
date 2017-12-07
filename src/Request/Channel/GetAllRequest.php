<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\RequestAbstract;

/**
 * Request to get all Channels for the given Service Id.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class GetAllRequest extends RequestAbstract
{
    /**
     * Get all channels for a service by the Service Id.
     *
     * @param int $serviceId
     *   The Service ID to get all channels for.
     */
    public function __construct($serviceId)
    {
        $uri = sprintf('services/%d/channels', (int) $serviceId);

        parent::__construct($uri);
    }
}
