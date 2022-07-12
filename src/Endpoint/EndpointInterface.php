<?php

declare(strict_types=1);

namespace Updevru\Dkron\Endpoint;

interface EndpointInterface
{
    public function getAvailableEndpoint(): Endpoint;

    public function makeUnavailable(Endpoint $endpoint): void;
}
