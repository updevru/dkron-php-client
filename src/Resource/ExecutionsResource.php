<?php

namespace Updevru\Dkron\Resource;

use Updevru\Dkron\Dto\ExecutionDto;

class ExecutionsResource extends AbstractResource
{
    /**
     * Returns the running executions.
     * @return ExecutionDto[]
     */
    public function getExecutions() : array
    {
        return $this->serializer->deserialize(
            $this->client->get('/busy'),
            ExecutionDto::class,
            true
        );
    }

    /**
     * List executions.
     * @param string $jobName
     * @return ExecutionDto[]
     */
    public function getExecutionsByJob(string $jobName) : array
    {
        return $this->serializer->deserialize(
            $this->client->get(sprintf('/jobs/%s/executions', $jobName)),
            ExecutionDto::class,
            true
        );
    }

    /**
     * Get execution.
     * @param string $jobName
     * @param string $executionId
     *
     * @return ExecutionDto
     */
    public function getExecutionById(string $jobName, string $executionId) : ExecutionDto
    {
        return $this->serializer->deserialize(
            $this->client->get(sprintf('/jobs/%s/executions/%s', $jobName, $executionId)),
            ExecutionDto::class
        );
    }
}