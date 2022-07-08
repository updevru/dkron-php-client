<?php


namespace Updevru\Dkron\Serializer;

use JMS\Serializer\Context;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\JsonDeserializationVisitor;

class JMSCustomHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'CustomDateTime',
                'method' => 'deserializeDateTimeFromJson',
            ]
        ];
    }

    public function cutMilliSeconds(string $date) : string
    {
        if (preg_match('/\.([\d+]+)/m', $date)) {
            $date = preg_replace_callback(
                '/\.([\d+]+)/m',
                function ($matches) {
                    return substr($matches[0], 0, 6);
                },
                $date
            );
        }

        return $date;
    }

    public function deserializeDateTimeFromJson(JsonDeserializationVisitor $visitor, $dateAsString, array $type, Context $context)
    {
        return new \DateTime($this->cutMilliSeconds($dateAsString));
    }
}