<?php

declare(strict_types=1);

namespace Updevru\Dkron\Dto;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class MemberDto
{
    /**
     * @Type("string")
     * @SerializedName("Name")
     */
    private string $name;

    /**
     * @Type("string")
     * @SerializedName("Addr")
     */
    private string $addr;

    /**
     * @Type("int")
     * @SerializedName("Port")
     */
    private int $port;

    /**
     * @Type("array<string,string>")
     * @SerializedName("Tags")
     */
    private array $tags;

    /**
     * @Type("int")
     * @SerializedName("Status")
     */
    private int $status;

    /**
     * @Type("int")
     * @SerializedName("ProtocolMin")
     */
    private int $protocolMin;

    /**
     * @Type("int")
     * @SerializedName("ProtocolMax")
     */
    private int $protocolMax;

    /**
     * @Type("int")
     * @SerializedName("ProtocolCur")
     */
    private int $protocolCur;

    /**
     * @Type("int")
     * @SerializedName("DelegateMin")
     */
    private int $delegateMin;

    /**
     * @Type("int")
     * @SerializedName("DelegateMax")
     */
    private int $delegateMax;

    /**
     * @Type("int")
     * @SerializedName("DelegateCur")
     */
    private int $delegateCur;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAddr(): string
    {
        return $this->addr;
    }

    public function setAddr(string $addr): void
    {
        $this->addr = $addr;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getProtocolMin(): int
    {
        return $this->protocolMin;
    }

    public function setProtocolMin(int $protocolMin): void
    {
        $this->protocolMin = $protocolMin;
    }

    public function getProtocolMax(): int
    {
        return $this->protocolMax;
    }

    public function setProtocolMax(int $protocolMax): void
    {
        $this->protocolMax = $protocolMax;
    }

    public function getProtocolCur(): int
    {
        return $this->protocolCur;
    }

    public function setProtocolCur(int $protocolCur): void
    {
        $this->protocolCur = $protocolCur;
    }

    public function getDelegateMin(): int
    {
        return $this->delegateMin;
    }

    public function setDelegateMin(int $delegateMin): void
    {
        $this->delegateMin = $delegateMin;
    }

    public function getDelegateMax(): int
    {
        return $this->delegateMax;
    }

    public function setDelegateMax(int $delegateMax): void
    {
        $this->delegateMax = $delegateMax;
    }

    public function getDelegateCur(): int
    {
        return $this->delegateCur;
    }

    public function setDelegateCur(int $delegateCur): void
    {
        $this->delegateCur = $delegateCur;
    }
}
