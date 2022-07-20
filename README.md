# Dkron PHP Client

[![Build Status](https://github.com/retailcrm/api-client-php/workflows/CI/badge.svg)](https://github.com/updevru/dkron-php-client/actions)
[![Latest stable](https://img.shields.io/packagist/v/updevru/dkron-php-client.svg)](https://packagist.org/packages/updevru/dkron-php-client)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/updevru/dkron-php-client.svg?logo=php&logoColor=white)](https://packagist.org/packages/updevru/dkron-php-client)

This is the PHP [Dkron](https://dkron.io) API client. This library allows using of the actual API version.
You can find more info in the [documentation](https://dkron.io/api/).

# Table of contents

* [Requirements](#requirements)
* [Installation](#installation)
* [Usage](#usage)
* [Testing](#testing)


## Requirements

* PHP 7.4 and above
* PHP's cURL support
* PHP's JSON support
* Any HTTP client compatible with PSR-18 (covered by the installation instructions).
* Any HTTP factories implementation compatible with PSR-17 (covered by the installation instructions).
* Any HTTP messages implementation compatible with PSR-7 (covered by the installation instructions).

## Installation

Install the library from the Packagist by executing this command:

```bash
composer require updevru/dkron-php-client
```

**Note:** API client uses php-http/curl-client and nyholm/psr7 as a PSR-18, PSR-17 and PSR-7 implementation. 
You can replace those implementations during installation by installing this library with the implementation of your choice, like this:

```bash
composer require php-http/curl-client nyholm/psr7 updevru/dkron-php-client
```

## Usage

Firstly, you should initialize the Client. 

```php
use Http\Client\Curl\Client;
use Nyholm\Psr7\Factory\Psr17Factory;
use Updevru\Dkron\ApiClient;
use Updevru\Dkron\Endpoint\EndpointCollection;

$client = new Updevru\Dkron\ApiClient(
    new Updevru\Dkron\Endpoint\EndpointCollection(
        [
            [
                'url' => 'http://localhost',
                'login' => null,
                'password' => null,
            ]
        ]
    ),
    new Http\Client\Curl\Client(),
    new Nyholm\Psr7\Factory\Psr17Factory(),
    new Nyholm\Psr7\Factory\Psr17Factory()
);

$api = new \Updevru\Dkron\Api($client, new \Updevru\Dkron\Serializer\JMSSerializer());
```

If HTTP basic authorization is enabled, enter login and password.

Create new job:

```php
$newJob = new \Updevru\Dkron\Dto\JobDto();
$newJob->setName('test_job');
$newJob->setSchedule('*/2 * * * * *');
$newJob->setConcurrency(\Updevru\Dkron\Dto\JobDto::CONCURRENCY_FORBID);
$newJob->setExecutor('shell');
$newJob->setExecutorConfig(['command' => 'echo Hello']);

$api->jobs->createOrUpdateJob($newJob);
```

Run job manually:

```php
$api->jobs->runJob('test_job');
```

Show list executions:

```php
$jobs = $api->jobs->getJobs();
```

Disable job:

```php
$api->jobs->toggleJob('test_job');
```

Deleting job test_job:

```php
$api->jobs->deleteJob('test_job');
```

## Testing

Run unit tests:

```bash
composer tests
```

Demo working library:

```bash
php bin/test.php http://localhost:8080
```