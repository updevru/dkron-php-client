<?php


namespace Updevru\Dkron\Dto;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class MemberDto
{
    /**
     * @var string
     * @Type("string")
     * @SerializedName("Name")
     */
    private $name;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("Addr")
     */
    private $addr;

    /**
     * @var int
     * @Type("int")
     * @SerializedName("Port")
     */
    private $port;

    /**
     * @var array
     * @Type("array<string,string>")
     * @SerializedName("Tags")
     */
    private $tags;

    /**
     * @var int
     * @Type("int")
     * @SerializedName("Status")
     */
    private $status;

    /**
     * @var int
     * @Type("int")
     * @SerializedName("ProtocolMin")
     */
    private $protocolMin;

    /**
     * @var int
     * @Type("int")
     * @SerializedName("ProtocolMax")
     */
    private $protocolMax;

    /**
     * @var int
     * @Type("int")
     * @SerializedName("ProtocolCur")
     */
    private $protocolCur;

    /**
     * @var int
     * @Type("int")
     * @SerializedName("DelegateMin")
     */
    private $delegateMin;

    /**
     * @var int
     * @Type("int")
     * @SerializedName("DelegateMax")
     */
    private $delegateMax;

    /**
     * @var int
     * @Type("int")
     * @SerializedName("DelegateCur")
     */
    private $delegateCur;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddr(): string
    {
        return $this->addr;
    }

    /**
     * @param string $addr
     */
    public function setAddr(string $addr): void
    {
        $this->addr = $addr;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getProtocolMin(): int
    {
        return $this->protocolMin;
    }

    /**
     * @param int $protocolMin
     */
    public function setProtocolMin(int $protocolMin): void
    {
        $this->protocolMin = $protocolMin;
    }

    /**
     * @return int
     */
    public function getProtocolMax(): int
    {
        return $this->protocolMax;
    }

    /**
     * @param int $protocolMax
     */
    public function setProtocolMax(int $protocolMax): void
    {
        $this->protocolMax = $protocolMax;
    }

    /**
     * @return int
     */
    public function getProtocolCur(): int
    {
        return $this->protocolCur;
    }

    /**
     * @param int $protocolCur
     */
    public function setProtocolCur(int $protocolCur): void
    {
        $this->protocolCur = $protocolCur;
    }

    /**
     * @return int
     */
    public function getDelegateMin(): int
    {
        return $this->delegateMin;
    }

    /**
     * @param int $delegateMin
     */
    public function setDelegateMin(int $delegateMin): void
    {
        $this->delegateMin = $delegateMin;
    }

    /**
     * @return int
     */
    public function getDelegateMax(): int
    {
        return $this->delegateMax;
    }

    /**
     * @param int $delegateMax
     */
    public function setDelegateMax(int $delegateMax): void
    {
        $this->delegateMax = $delegateMax;
    }

    /**
     * @return int
     */
    public function getDelegateCur(): int
    {
        return $this->delegateCur;
    }

    /**
     * @param int $delegateCur
     */
    public function setDelegateCur(int $delegateCur): void
    {
        $this->delegateCur = $delegateCur;
    }
}