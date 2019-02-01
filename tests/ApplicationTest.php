<?php

namespace Tests;

use Tests\BladeTestCase;
use Mockery\MockInterface;
use \Mockery;
use Mindedge\Blade\Application;

class ApplicationTest extends BladeTestCase{

    public function testConstructorMethodsCalled(){
        $mock = \Mockery::mock(Mindedge\Blade\Application::class)->makePartial();


        $mock->shouldReceive('bootstrapContainer')->andSet('basePath', null);
    }

}