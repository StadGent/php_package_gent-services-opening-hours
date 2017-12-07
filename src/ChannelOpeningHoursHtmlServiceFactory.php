<?php

namespace StadGent\Services\OpeningHours;

use StadGent\Services\OpeningHours\Client\ClientInterface;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHtmlHandler;
use StadGent\Services\OpeningHours\Service\Channel\ChannelOpeningHoursHtmlService;

/**
 * Factory to create the ChannelOpeningHoursHtmlService.
 *
 * @package StadGent\Services\OpeningHours
 */
class ChannelOpeningHoursHtmlServiceFactory
{
    /**
     * Expects a Client object.
     *
     * Will add the package handlers and inject the client and optional cache
     * into the ServiceService.
     *
     * @param \StadGent\Services\OpeningHours\Client\ClientInterface $client
     * @param \Psr\SimpleCache\CacheInterface $cache
     *
     * @return \StadGent\Services\OpeningHours\Service\Channel\ChannelOpeningHoursHtmlService
     */
    public static function create(ClientInterface $client, CacheInterface $cache = null)
    {
        $client
            ->addHandler(new OpenNowHtmlHandler())
            ->addHandler(new OpeningHoursHtmlHandler())
        ;

        $service = new ChannelOpeningHoursHtmlService($client);
        if ($cache) {
            $service->setCacheService($cache);
        }

        return $service;
    }
}
