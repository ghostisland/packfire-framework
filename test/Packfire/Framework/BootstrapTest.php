<?php

namespace Packfire\Framework;

use PHPUnit_Framework_TestCase;
use Packfire\FuelBlade\Container;

class BootstrapTest extends PHPUnit_Framework_TestCase
{
    public function testGetContainer()
    {
        $bootstrap = new Bootstrap();
        $this->assertInstanceof('Packfire\\FuelBlade\\ContainerInterface', $bootstrap->getContainer());
    }

    public function testGetContainer2()
    {
        $container = new Container();
        $bootstrap = new Bootstrap($container);
        $this->assertInstanceof('Packfire\\FuelBlade\\ContainerInterface', $bootstrap->getContainer());
        $this->assertEquals($container, $bootstrap->getContainer());
    }

    public function testBootPath()
    {
        $bootstrap = new Bootstrap();
        $this->assertEquals(__FILE__, $bootstrap->bootPath());
    }

    public function testRun()
    {
        $bootstrap = new Bootstrap();
        $container = $bootstrap->getContainer();
        $this->assertFalse(isset($container['Packfire\\Router\\RouterInterface']));
        $bootstrap->run();
        $this->assertInstanceOf('Packfire\\Router\\RouterInterface', $container['Packfire\\Router\\RouterInterface']);
    }
}
