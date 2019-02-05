<?php

use Mindedge\Blade\Application;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\ServiceProvider;

class ApplicationTest extends TestCase{

    public function setup(){
        parent::setup();
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    public function testRegisterServiceProvider()
    {
        $app = new Application;
        $provider = new BladeTestServiceProvider($app);
        $app->register($provider);
        $this->assertTrue(true);
    }

    public function testEnvironmentDetection()
    {
        $app = new Application;
        $this->assertEquals('production', $app->environment());
        $this->assertTrue($app->environment('production'));
        $this->assertTrue($app->environment(['production']));
    }

    public function testApplicationBootsServiceProvidersOnBoot()
    {
        $app = new Application();
        $provider = new BladeBootableTestServiceProvider($app);
        $app->register($provider);
        $this->assertFalse($provider->booted);
        $app->boot();
        $this->assertTrue($provider->booted);
    }

    public function testRegisterServiceProviderAfterBoot()
    {
        $app = new Application();
        $provider = new BladeBootableTestServiceProvider($app);
        $app->boot();
        $app->register($provider);
        $this->assertTrue($provider->booted);
    }
}


//MOCKS FOR TESTING
class BladeTestService
{
}
class BladeTestServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
}
class BladeBootableTestServiceProvider extends ServiceProvider
{
    public $booted = false;
    public function boot()
    {
        $this->booted = true;
    }
}