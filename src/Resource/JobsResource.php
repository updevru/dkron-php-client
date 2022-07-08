<?php

namespace Updevru\Dkron\Resource;

use Updevru\Dkron\Dto\JobDto;
use Updevru\Dkron\Value\JobSearchValue;

class JobsResource extends AbstractResource
{
    /**
     * List jobs.
     * @param JobSearchValue|null $searchValue
     * @return JobDto[]
     */
    public function getJobs(JobSearchValue $searchValue = null) : array
    {
        return $this->serializer->deserialize(
            $this->client->get('/jobs', $searchValue ? $searchValue->getRequest() : []),
            JobDto::class,
            true
        );
    }

    /**
     * Create or updates a new job.
     * @param JobDto $job
     * @param bool|null $runOnCreate If present, regardless of any value, causes the job to be run immediately after being successfully created or updated.
     * @return JobDto
     */
    public function createOrUpdateJob(JobDto $job, bool $runOnCreate = null) : JobDto
    {
        return $this->serializer->deserialize(
            $this->client->post(
                '/jobs',
                $this->serializer->serialize($job),
                ($runOnCreate === true) ? ['runoncreate' => 1] : null
            ),
            JobDto::class
        );
    }

    /**
     * Show a job.
     * @param string $jobName
     * @return JobDto
     */
    public function getJobByName(string $jobName) : JobDto
    {
        return $this->serializer->deserialize(
            $this->client->get(sprintf('/jobs/%s', $jobName)),
            JobDto::class
        );
    }

    /**
     * Run a job.
     * @param string $jobName
     * @return JobDto
     */
    public function runJob(string $jobName) : JobDto
    {
        return $this->serializer->deserialize(
            $this->client->post(sprintf('/jobs/%s', $jobName)),
            JobDto::class
        );
    }

    /**
     * Delete a job.
     * @param string $jobName
     * @return JobDto
     */
    public function deleteJob(string $jobName) : JobDto
    {
        return $this->serializer->deserialize(
            $this->client->delete(sprintf('/jobs/%s', $jobName)),
            JobDto::class
        );
    }

    /**
     * Toggle a job.
     * @param string $jobName
     * @return JobDto
     */
    public function toggleJob(string $jobName) : JobDto
    {
        return $this->serializer->deserialize(
            $this->client->post(sprintf('/jobs/%s/toggle', $jobName)),
            JobDto::class
        );
    }

    /**
     * Restore jobs from json.
     * @param string $jsonData
     * @return JobDto
     */
    public function restoreJobFromJson(string $jsonData) : JobDto
    {
        return $this->serializer->deserialize(
            $this->client->post('/jobs', $jsonData),
            JobDto::class
        );
    }
}