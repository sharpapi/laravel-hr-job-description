<?php

declare(strict_types=1);

namespace SharpAPI\HrJobDescription;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use SharpAPI\Core\Client\SharpApiClient;
use SharpAPI\HrJobDescription\Dto\JobDescriptionParameters;

/**
 * @api
 */
class HrJobDescriptionService extends SharpApiClient
{
    /**
     * Initializes a new instance of the class.
     *
     * @throws InvalidArgumentException if the API key is empty.
     */
    public function __construct()
    {
        parent::__construct(config('sharpapi-hr-job-description.api_key'));
        $this->setApiBaseUrl(
            config(
                'sharpapi-hr-job-description.base_url',
                'https://sharpapi.com/api/v1'
            )
        );
        $this->setApiJobStatusPollingInterval(
            (int) config(
                'sharpapi-hr-job-description.api_job_status_polling_interval',
                5)
        );
        $this->setApiJobStatusPollingWait(
            (int) config(
                'sharpapi-hr-job-description.api_job_status_polling_wait',
                180)
        );
        $this->setUserAgent('SharpAPILaravelHrJobDescription/1.0.0');
    }

    /**
     * Generates a job description based on a set of parameters
     * provided via JobDescriptionParameters DTO object.
     * This endpoint provides concise job details in the response format,
     * including the short description, job requirements, and job responsibilities.
     *
     * Only the job position `name` parameter is required inside $jobDescriptionParameters
     *
     * @throws GuzzleException
     *
     * @api
     */
    public function generateJobDescription(JobDescriptionParameters $jobDescriptionParameters): string
    {
        $response = $this->makeRequest(
            'POST',
            '/hr/job_description',
            $jobDescriptionParameters->toArray());

        return $this->parseStatusUrl($response);
    }
}