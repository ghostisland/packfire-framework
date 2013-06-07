<?php

namespace Packfire\View;

/**
 * Test class for Theme.
 * Generated by PHPUnit on 2012-09-19 at 02:49:42.
 */
class ThemeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Packfire\View\Theme
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     * @covers \Packfire\View\Theme::__construct
     */
    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass('Packfire\View\Theme');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers \Packfire\View\Theme::fields
     */
    public function testFields()
    {
        $this->assertInstanceOf('Packfire\Collection\Map', $this->object->fields());
    }

    /**
     * @covers \Packfire\View\Theme::define
     */
    public function testDefine()
    {
        $method = new \ReflectionMethod($this->object, 'define');
        $method->setAccessible(true);
        $method->invoke($this->object, 'test', 'sim');
        $this->assertEquals('sim', $this->object->fields()->get('test'));
        $method->invoke($this->object, array('test2' => 5));
        $this->assertEquals(5, $this->object->fields()->get('test2'));
    }
}
