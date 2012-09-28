<?php

pload('packfire.controller.pActionInvoker');

/**
 * Test class for pActionInvoker.
 * Generated by PHPUnit on 2012-09-28 at 02:25:22.
 */
class pActionInvokerTest extends PHPUnit_Framework_TestCase {

    /**
     * @var pActionInvoker
     */
    protected $object;
    
    protected $params = array();

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function action($name, $age){
        $this->params = func_get_args();
    }

    /**
     * @covers pActionInvoker::invoke
     */
    public function testInvoke() {
        $object = new pActionInvoker(array($this, 'action'));
        $object->invoke(array('age' => 5, 'name' => 'John Smith'));
        $this->assertEquals(array('John Smith', 5), $this->params);
    }

    /**
     * @covers pActionInvoker::invoke
     */
    public function testInvoke2() {
        $params = array();
        $object = new pActionInvoker(function($name, $age) use($params){
            $params = func_get_args();
        });
        $object->invoke(array('age' => 5, 'name' => 'John Smith'));
        $this->assertEquals(array('John Smith', 5), $params);
    }

}