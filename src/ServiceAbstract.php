<?php

namespace StadGent\Services\OpeningHours;

use StadGent\Services\OpeningHours\Client\ClientInterface;
use StadGent\Services\OpeningHours\Request\RequestInterface;
use StadGent\Services\OpeningHours\Exception\UnexpectedResponseException;

/**
 * Class ServiceAbstract.
 *
 * @package StadGent\Services\OpeningHours
 */
abstract class ServiceAbstract implements ServiceInterface
{
    /**
     * @var \StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected $client;

    /**
     * @inheritdoc
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Send the request using the client and validate the response object.
     *
     * @param \StadGent\Services\OpeningHours\Request\RequestInterface $request
     *   The request object to send trough the client.
     * @param string $expectedResponseClassName
     *   The expected response class.
     *
     * @return \StadGent\Services\OpeningHours\Response\ResponseInterface
     *
     * @throws \StadGent\Services\OpeningHours\Exception\UnexpectedResponseException
     */
    protected function send(RequestInterface $request, $expectedResponseClassName)
    {
        // Get from service.
        $response = $this->client->send($request);

        if (!$response instanceof $expectedResponseClassName) {
            throw UnexpectedResponseException::fromClass(
                get_class($response),
                $expectedResponseClassName
            );
        }

        return $response;
    }
}
