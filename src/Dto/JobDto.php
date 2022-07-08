<?php

namespace Updevru\Dkron\Dto;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class JobDto
{
    const CONCURRENCY_ALLOW = 'allow';
    const CONCURRENCY_FORBID = 'forbid';

    const STATUS_SUCCESS = 'success';

    /**
     * @var string
     * @Type("string")
     * @SerializedName("concurrency")
     */
    private $concurrency = self::CONCURRENCY_ALLOW;

    /**
     * @var string[]
     * @SerializedName("dependent_jobs")
     * @Type("array<string>")
     */
    private $dependentJobs;

    /**
     * @var bool
     * @Type("bool")
     * @SerializedName("disabled")
     */
    private $disabled = false;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("executor")
     */
    private $executor;

    /**
     * @var string[]
     * @Type("array<string,string>")
     * @SerializedName("executor_config")
     */
    private $executorConfig = [];

    /**
     * @var int
     * @Type("int")
     * @SerializedName("error_count")
     */
    private $errorCount;

    /**
     * @var \DateTime
     * @Type("CustomDateTime")
     * @SerializedName("last_error")
     */
    private $lastError;

    /**
     * @var \DateTime
     * @Type("CustomDateTime")
     * @SerializedName("last_success")
     */
    private $lastSuccess;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("name")
     */
    private $name;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("displayname")
     */
    private $displayName;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("owner")
     */
    private $owner;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("owner_email")
     */
    private $ownerEmail;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("parent_job")
     */
    private $parentJob;

    /**
     * @var array
     * @Type("string")
     * @SerializedName("parent_job")
     */
    private $processors;

    /**
     * @var int
     * @Type("int")
     * @SerializedName("retries")
     */
    private $retries = 0;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("schedule")
     */
    private $schedule = "* * * * * *";

    /**
     * @var int
     * @Type("int")
     * @SerializedName("success_count")
     */
    private $successCount;

    /**
     * @var array[string]string
     * @Type("array<string,string>")
     * @SerializedName("tags")
     */
    private $tags;

    /**
     * @var array[string]string
     * @Type("array<string,string>")
     * @SerializedName("metadata")
     */
    private $metadata;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("timezone")
     */
    private $timezone;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("status")
     */
    private $status;

    /**
     * @var \DateTime|null
     * @Type("CustomDateTime")
     * @SerializedName("next")
     */
    private $next;

    /**
     * @var \DateTime|null
     * @Type("CustomDateTime")
     * @SerializedName("expires_at")
     */
    private $expiresAt;

    /**
     * @var bool
     * @Type("bool")
     * @SerializedName("ephemeral")
     */
    private $ephemeral = false;

    /**
     * @return string
     */
    public function getConcurrency(): string
    {
        return $this->concurrency;
    }

    /**
     * @param string $concurrency
     */
    public function setConcurrency(string $concurrency): void
    {
        $this->concurrency = $concurrency;
    }

    /**
     * @return string[]|null
     */
    public function getDependentJobs(): ?array
    {
        return $this->dependentJobs;
    }

    /**
     * @param string[] $dependentJobs
     */
    public function setDependentJobs(array $dependentJobs): void
    {
        $this->dependentJobs = $dependentJobs;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     */
    public function setDisabled(bool $disabled): void
    {
        $this->disabled = $disabled;
    }

    /**
     * @return string
     */
    public function getExecutor(): string
    {
        return $this->executor;
    }

    /**
     * @param string $executor
     */
    public function setExecutor(string $executor): void
    {
        $this->executor = $executor;
    }

    /**
     * @return string[]
     */
    public function getExecutorConfig(): array
    {
        return $this->executorConfig;
    }

    /**
     * @param string[] $executorConfig
     */
    public function setExecutorConfig(array $executorConfig): void
    {
        $this->executorConfig = $executorConfig;
    }

    /**
     * @return int
     */
    public function getErrorCount(): int
    {
        return $this->errorCount;
    }

    /**
     * @param int $errorCount
     */
    public function setErrorCount(int $errorCount): void
    {
        $this->errorCount = $errorCount;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastError(): ?\DateTime
    {
        return $this->lastError;
    }

    /**
     * @param \DateTime $lastError
     */
    public function setLastError(\DateTime $lastError): void
    {
        $this->lastError = $lastError;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastSuccess(): ?\DateTime
    {
        return $this->lastSuccess;
    }

    /**
     * @param \DateTime $lastSuccess
     */
    public function setLastSuccess(\DateTime $lastSuccess): void
    {
        $this->lastSuccess = $lastSuccess;
    }

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
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     */
    public function setDisplayName(string $displayName): void
    {
        $this->displayName = $displayName;
    }

    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     */
    public function setOwner(string $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @return string
     */
    public function getOwnerEmail(): string
    {
        return $this->ownerEmail;
    }

    /**
     * @param string $ownerEmail
     */
    public function setOwnerEmail(string $ownerEmail): void
    {
        $this->ownerEmail = $ownerEmail;
    }

    /**
     * @return string
     */
    public function getParentJob(): string
    {
        return $this->parentJob;
    }

    /**
     * @param string $parentJob
     */
    public function setParentJob(string $parentJob): void
    {
        $this->parentJob = $parentJob;
    }

    /**
     * @return array
     */
    public function getProcessors(): array
    {
        return (is_array($this->processors)) ? $this->processors : [];
    }

    /**
     * @param array $processors
     */
    public function setProcessors(array $processors): void
    {
        $this->processors = $processors;
    }

    /**
     * @return int
     */
    public function getRetries(): int
    {
        return $this->retries;
    }

    /**
     * @param int $retries
     */
    public function setRetries(int $retries): void
    {
        $this->retries = $retries;
    }

    /**
     * @return string
     */
    public function getSchedule(): string
    {
        return $this->schedule;
    }

    /**
     * @param string $schedule
     */
    public function setSchedule(string $schedule): void
    {
        $this->schedule = $schedule;
    }

    /**
     * @return int
     */
    public function getSuccessCount(): int
    {
        return $this->successCount;
    }

    /**
     * @param int $successCount
     */
    public function setSuccessCount(int $successCount): void
    {
        $this->successCount = $successCount;
    }

    /**
     * @return array|null
     */
    public function getTags(): ?array
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
     * @return array|null
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    /**
     * @param array $metadata
     */
    public function setMetadata(array $metadata): void
    {
        $this->metadata = $metadata;
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime|null
     */
    public function getNext(): ?\DateTime
    {
        return $this->next;
    }

    /**
     * @param \DateTime $next
     */
    public function setNext(\DateTime $next): void
    {
        $this->next = $next;
    }

    /**
     * @return \DateTime|null
     */
    public function getExpiresAt(): ?\DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @param \DateTime $expiresAt
     */
    public function setExpiresAt(\DateTime $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return bool
     */
    public function isEphemeral(): bool
    {
        return $this->ephemeral;
    }

    /**
     * @param bool $ephemeral
     */
    public function setEphemeral(bool $ephemeral): void
    {
        $this->ephemeral = $ephemeral;
    }
}