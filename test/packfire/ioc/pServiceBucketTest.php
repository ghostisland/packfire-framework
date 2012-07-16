<?php

pload('packfire.ioc.pServiceBucket');
require_once('mocks/tMockConfig.php');

/**
 * Test class for pServiceBucket.
 * Generated by PHPUnit on 2012-06-29 at 00:59:56.
 */
class pServiceBucketTest extends PHPUnit_Framework_TestCase {

    /**
     * @var pServiceBucket
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new pServiceBucket;
        $this->object->put('test', new tMockConfig());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers pServiceBucket::__call
     */
    public function test__call() {
        $this->assertInstanceOf('tMockConfig', $this->object->testService());
        $this->assertNull($this->object->nullService());
    }

    /**
     * @covers pServiceBucket::put
     * @covers pServiceBucket::pick
     */
    public function testPutPick() {
        $this->object->put('break', function(){return new stdClass();});
        $this->assertInstanceOf('stdClass', $this->object->pick('break'));
        $this->object->put('bend', array($this, 'load'));
        $this->assertInstanceOf('stdClass', $this->object->pick('bend'));
    }
    
    public function load(){
        return new stdClass();
    }

    /**
     * @covers pServiceBucket::contains
     */
    public function testContains() {
        $this->assertTrue($this->object->contains('test'));
        $this->assertFalse($this->object->contains('null'));
    }

}