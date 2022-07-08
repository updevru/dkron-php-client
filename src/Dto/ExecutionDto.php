<?php


namespace Updevru\Dkron\Dto;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class ExecutionDto
{
    /**
     * @var string
     * @Type("string")
     * @SerializedName("id")
     */
    private $id;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("job_name")
     */
    private $jobName;

    /**
     * @var \DateTime
     * @Type("CustomDateTime")
     * @SerializedName("started_at")
     */
    private $startedAt;

    /**
     * @var \DateTime
     * @Type("CustomDateTime")
     * @SerializedName("finished_at")
     */
    private $finishedAt;

    /**
     * @var bool
     * @Type("bool")
     * @SerializedName("success")
     */
    private $success;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("output")
     */
    private $output;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("node_name")
     */
    private $nodeName;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("group")
     */
    private $group;

    /**
     * @var integer
     * @Type("integer")
     * @SerializedName("attempt")
     */
    private $attempt;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getJobName(): string
    {
        return $this->jobName;
    }

    /**
     * @param string $jobName
     */
    public function setJobName(string $jobName): void
    {
        $this->jobName = $jobName;
    }

    /**
     * @return \DateTime
     */
    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    /**
     * @param \DateTime $startedAt
     */
    public function setStartedAt(\DateTime $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    /**
     * @return \DateTime
     */
    public function getFinishedAt(): \DateTime
    {
        return $this->finishedAt;
    }

    /**
     * @param \DateTime $finishedAt
     */
    public function setFinishedAt(\DateTime $finishedAt): void
    {
        $this->finishedAt = $finishedAt;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }

    /**
     * @param string $output
     */
    public function setOutput(string $output): void
    {
        $this->output = $output;
    }

    /**
     * @return string
     */
    public function getNodeName(): string
    {
        return $this->nodeName;
    }

    /**
     * @param string $nodeName
     */
    public function setNodeName(string $nodeName): void
    {
        $this->nodeName = $nodeName;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup(string $group): void
    {
        $this->group = $group;
    }

    /**
     * @return int
     */
    public function getAttempt(): int
    {
        return $this->attempt;
    }

    /**
     * @param int $attempt
     */
    public function setAttempt(int $attempt): void
    {
        $this->attempt = $attempt;
    }
}