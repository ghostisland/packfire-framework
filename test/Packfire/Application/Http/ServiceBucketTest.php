<?php
namespace Packfire\Application\Http;

use Packfire\IoC\ServiceBucket as Bucket;

/**
 * Test class for ServiceBucket.
 * Generated by PHPUnit on 2012-09-17 at 07:27:54.
 */
class ServiceBucketTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var ServiceBucket
     */
    protected $object;
    
    /**
     *
     * @var Bucket 
     */
    protected $bucket;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->bucket = new Bucket();
        $this->object = new ServiceBucket($this->bucket);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers pHttpServiceBucket::load
     */
    public function testLoad() {
        $this->object->load();
        $this->assertTrue($this->bucket->contains('config.routing'));
        $this->assertInstanceOf('Packfire\Route\Http\Router', $this->bucket->pick('router'));        
    }

}