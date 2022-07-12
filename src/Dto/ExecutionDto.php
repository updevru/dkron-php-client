<?php

declare(strict_types=1);

namespace Updevru\Dkron\Dto;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class ExecutionDto
{
    /**
     * @Type("string")
     * @SerializedName("id")
     */
    private string $id;

    /**
     * @Type("string")
     * @SerializedName("job_name")
     */
    private string $jobName;

    /**
     * @Type("CustomDateTime")
     * @SerializedName("started_at")
     */
    private \DateTime $startedAt;

    /**
     * @Type("CustomDateTime")
     * @SerializedName("finished_at")
     */
    private \DateTime $finishedAt;

    /**
     * @Type("bool")
     * @SerializedName("success")
     */
    private bool $success;

    /**
     * @Type("string")
     * @SerializedName("output")
     */
    private string $output;

    /**
     * @Type("string")
     * @SerializedName("node_name")
     */
    private string $nodeName;

    /**
     * @Type("string")
     * @SerializedName("group")
     */
    private string $group;

    /**
     * @Type("integer")
     * @SerializedName("attempt")
     */
    private int $attempt;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getJobName(): string
    {
        return $this->jobName;
    }

    public function setJobName(string $jobName): void
    {
        $this->jobName = $jobName;
    }

    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTime $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getFinishedAt(): \DateTime
    {
        return $this->finishedAt;
    }

    public function setFinishedAt(\DateTime $finishedAt): void
    {
        $this->finishedAt = $finishedAt;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    public function getOutput(): string
    {
        return $this->output;
    }

    public function setOutput(string $output): void
    {
        $this->output = $output;
    }

    public function getNodeName(): string
    {
        return $this->nodeName;
    }

    public function setNodeName(string $nodeName): void
    {
        $this->nodeName = $nodeName;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setGroup(string $group): void
    {
        $this->group = $group;
    }

    public function getAttempt(): int
    {
        return $this->attempt;
    }

    public function setAttempt(int $attempt): void
    {
        $this->attempt = $attempt;
    }
}
