<?php


namespace Updevru\Dkron\Endpoint;


interface EndpointInterface
{
    public function getAvailableEndpoint(): string;
}