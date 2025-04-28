<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
*/

uses(
    TestCase::class,
    RefreshDatabase::class
)->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

function createUser(array $attributes = []): \App\Models\User
{
    return \App\Models\User::factory()->create($attributes);
}

function createEmployer(array $attributes = []): \App\Models\Employer
{
    return \App\Models\Employer::factory()->create($attributes);
}

function createJob(array $attributes = []): \App\Models\Job
{
    return \App\Models\Job::factory()->create($attributes);
}
