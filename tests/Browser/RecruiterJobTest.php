<?php
namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RecruiterJobTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegisterAndAddJob()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'Test Recruiter')
                    ->type('email', 'recruiter@test.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->select('role', 'recruiter')
                    ->press('Register')
                    ->screenshot('registration_response');

            $browser->visit('/login')
                    ->type('email', 'recruiter@test.com')
                    ->type('password', 'password')
                    ->press('Login')
                    ->waitForLocation('/dashboard/recruiter')
                    ->assertPathIs('/dashboard/recruiter');

            $browser->visit('/recruiter/jobs')
            ->clickLink('My Jobs')
            ->assertPathIs('/recruiter/jobs')
            ->press('Create Job')
            ->waitFor('#createJobModal', 5)
            ->within('#createJobModal', function ($modal) {
                $modal->type('title', 'Test Job')
                        ->type('description', 'This is a test job description.')
                        ->type('location', 'Test Location')
                        ->press('Create Job');
            })
            ->assertSee('Job created successfully');
        });
    }
}