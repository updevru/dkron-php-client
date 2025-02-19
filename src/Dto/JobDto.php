<?php

declare(strict_types=1);

namespace Updevru\Dkron\Dto;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;

class JobDto
{
    public const CONCURRENCY_ALLOW = 'allow';
    public const CONCURRENCY_FORBID = 'forbid';

    public const STATUS_SUCCESS = 'success';

    /**
     * @Type("string")
     * @SerializedName("concurrency")
     */
    private string $concurrency = self::CONCURRENCY_ALLOW;

    /**
     * @var string[]
     * @SerializedName("dependent_jobs")
     * @Type("array<string>")
     */
    private ?array $dependentJobs = null;

    /**
     * @Type("bool")
     * @SerializedName("disabled")
     */
    private bool $disabled = false;

    /**
     * @Type("string")
     * @SerializedName("executor")
     */
    private string $executor = 'shell';

    /**
     * @var string[]
     * @Type("array<string,string>")
     * @SerializedName("executor_config")
     */
    private array $executorConfig = [];

    /**
     * @Type("int")
     * @SerializedName("error_count")
     */
    private int $errorCount = 0;

    /**
     * @Type("CustomDateTime")
     * @SerializedName("last_error")
     */
    private ?\DateTime $lastError = null;

    /**
     * @var \DateTime
     * @Type("CustomDateTime")
     * @SerializedName("last_success")
     */
    private ?\DateTime $lastSuccess = null;

    /**
     * @Type("string")
     * @SerializedName("name")
     */
    private ?string $name = null;

    /**
     * @Type("string")
     * @SerializedName("displayname")
     */
    private ?string $displayName = null;

    /**
     * @Type("string")
     * @SerializedName("owner")
     */
    private ?string $owner = null;

    /**
     * @Type("string")
     * @SerializedName("owner_email")
     */
    private ?string $ownerEmail = null;

    /**
     * @Type("string")
     * @SerializedName("parent_job")
     */
    private ?string $parentJob = null;

    /**
     * @SkipWhenEmpty
     * @Type("array")
     * @SerializedName("processors")
     */
    private ?array $processors = [];

    /**
     * @Type("int")
     * @SerializedName("retries")
     */
    private int $retries = 0;

    /**
     * @Type("string")
     * @SerializedName("schedule")
     */
    private string $schedule = '* * * * * *';

    /**
     * @Type("int")
     * @SerializedName("success_count")
     */
    private int $successCount = 0;

    /**
     * @Type("array<string,string>")
     * @SerializedName("tags")
     */
    private ?array $tags = null;

    /**
     * @Type("array<string,string>")
     * @SerializedName("metadata")
     */
    private ?array $metadata = null;

    /**
     * @Type("string")
     * @SerializedName("timezone")
     */
    private ?string $timezone = null;

    /**
     * @Type("string")
     * @SerializedName("status")
     */
    private ?string $status = null;

    /**
     * @Type("CustomDateTime")
     * @SerializedName("next")
     */
    private ?\DateTime $next = null;

    /**
     * @Type("CustomDateTime")
     * @SerializedName("expires_at")
     */
    private ?\DateTime $expiresAt = null;

    /**
     * @Type("bool")
     * @SerializedName("ephemeral")
     */
    private bool $ephemeral = false;

    public function getConcurrency(): string
    {
        return $this->concurrency;
    }

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

    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    public function setDisabled(bool $disabled): void
    {
        $this->disabled = $disabled;
    }

    public function getExecutor(): string
    {
        return $this->executor;
    }

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

    public function getErrorCount(): int
    {
        return $this->errorCount;
    }

    public function setErrorCount(int $errorCount): void
    {
        $this->errorCount = $errorCount;
    }

    public function getLastError(): ?\DateTime
    {
        return $this->lastError;
    }

    public function setLastError(\DateTime $lastError): void
    {
        $this->lastError = $lastError;
    }

    public function getLastSuccess(): ?\DateTime
    {
        return $this->lastSuccess;
    }

    public function setLastSuccess(\DateTime $lastSuccess): void
    {
        $this->lastSuccess = $lastSuccess;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): void
    {
        $this->displayName = $displayName;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): void
    {
        $this->owner = $owner;
    }

    public function getOwnerEmail(): ?string
    {
        return $this->ownerEmail;
    }

    public function setOwnerEmail(string $ownerEmail): void
    {
        $this->ownerEmail = $ownerEmail;
    }

    public function getParentJob(): ?string
    {
        return $this->parentJob;
    }

    public function setParentJob(string $parentJob): void
    {
        $this->parentJob = $parentJob;
    }

    public function getProcessors(): array
    {
        return (array) $this->processors;
    }

    public function setProcessors(array $processors): void
    {
        $this->processors = $processors;
    }

    public function getRetries(): int
    {
        return $this->retries;
    }

    public function setRetries(int $retries): void
    {
        $this->retries = $retries;
    }

    public function getSchedule(): string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): void
    {
        $this->schedule = $schedule;
    }

    public function getSuccessCount(): int
    {
        return $this->successCount;
    }

    public function setSuccessCount(int $successCount): void
    {
        $this->successCount = $successCount;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function setMetadata(array $metadata): void
    {
        $this->metadata = $metadata;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getNext(): ?\DateTime
    {
        return $this->next;
    }

    public function setNext(\DateTime $next): void
    {
        $this->next = $next;
    }

    public function getExpiresAt(): ?\DateTime
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTime $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    public function isEphemeral(): bool
    {
        return $this->ephemeral;
    }

    public function setEphemeral(bool $ephemeral): void
    {
        $this->ephemeral = $ephemeral;
    }
}
