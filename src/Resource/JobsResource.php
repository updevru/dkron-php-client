<?php

declare(strict_types=1);

namespace Updevru\Dkron\Resource;

use Updevru\Dkron\Dto\JobDto;
use Updevru\Dkron\Value\JobSearchValue;

class JobsResource extends AbstractResource
{
    /**
     * List jobs.
     *
     * @return JobDto[]
     */
    public function getJobs(?JobSearchValue $searchValue = null): array
    {
        return $this->serializer->deserialize(
            $this->client->get('/jobs', $searchValue ? $searchValue->getRequest() : []),
            JobDto::class,
            true
        );
    }

    /**
     * Create or updates a new job.
     *
     * @param bool|null $runOnCreate if present, regardless of any value, causes the job to be run immediately after being successfully created or updated
     */
    public function createOrUpdateJob(JobDto $job, ?bool $runOnCreate = null): JobDto
    {
        return $this->serializer->deserialize(
            $this->client->post(
                '/jobs',
                $this->serializer->serialize($job),
                (true === $runOnCreate) ? ['runoncreate' => 1] : null
            ),
            JobDto::class
        );
    }

    /**
     * Show a job.
     */
    public function getJobByName(string $jobName): JobDto
    {
        return $this->serializer->deserialize(
            $this->client->get(sprintf('/jobs/%s', $jobName)),
            JobDto::class
        );
    }

    /**
     * Run a job.
     */
    public function runJob(string $jobName): JobDto
    {
        return $this->serializer->deserialize(
            $this->client->post(sprintf('/jobs/%s', $jobName)),
            JobDto::class
        );
    }

    /**
     * Delete a job.
     */
    public function deleteJob(string $jobName): JobDto
    {
        return $this->serializer->deserialize(
            $this->client->delete(sprintf('/jobs/%s', $jobName)),
            JobDto::class
        );
    }

    /**
     * Toggle a job.
     */
    public function toggleJob(string $jobName): JobDto
    {
        return $this->serializer->deserialize(
            $this->client->post(sprintf('/jobs/%s/toggle', $jobName)),
            JobDto::class
        );
    }

    /**
     * Restore jobs from json.
     */
    public function restoreJobFromJson(string $jsonData): JobDto
    {
        return $this->serializer->deserialize(
            $this->client->post('/jobs', $jsonData),
            JobDto::class
        );
    }
}
