<?php


namespace Updevru\Dkron\Serializer;

use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializerBuilder;

class JMSSerializer implements SerializerInterface
{
    /**
     * @var \JMS\Serializer\Serializer
     */
    private $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()
            ->configureHandlers(function (HandlerRegistry $registry) {
                $registry->registerSubscribingHandler(new JMSCustomHandler());
            })
            ->build()
        ;
    }

    public function serialize($data): string
    {
        return $this->serializer->serialize($data, 'json');
    }

    public function deserialize(string $data, string $type, bool $isArray = false)
    {
        return $this->serializer->deserialize(
            $data,
            ($isArray) ? sprintf('array<%s>', $type) : $type,
            'json'
        );
    }
}