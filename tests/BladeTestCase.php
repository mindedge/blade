<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class BladeTestCase extends TestCase{
    
    use MockeryPHPUnitIntegration;
    
    public function setup(){
        parent::setup();
    }
}