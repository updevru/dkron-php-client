<?php


namespace Updevru\Dkron\Serializer;


interface SerializerInterface
{
    /**
     * @param mixed $data
     *
     * @return string
     */
    public function serialize($data) : string;

    /**
     * @param string $data
     * @param string $type
     * @param bool $isArray
     * @return mixed
     */
    public function deserialize(string $data, string $type, bool $isArray = false);
}