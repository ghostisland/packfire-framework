<?php
pload('packfire.net.http.pHttpResponse');
pload('packfire.data.serialization.pXmlSerializer');
pload('packfire.text.pTextStream');

/**
 * pXmlResponse class
 * 
 * Provides an XML response to the client
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package packfire.response
 * @since 1.0-sofia
 */
class pXmlResponse extends pHttpResponse {
    
    /**
     * Create a new pXmlResponse object
     * @param mixed $object The object that will be encoded and sent to the
     *                      client
     * @since 1.0-sofia
     */
    public function __construct($object){
        parent::__construct();
        $this->headers()->add('Content-Type', 'application/xml');
        if(is_string($object)){ // probably already encoded
            $this->body($object); 
        }else{
            $stream = new pTextStream('<?xml version="1.0" encoding="UTF-8" ?>' . "\n");
            pXmlSerializer::serialize($stream, $object);
            $stream->seek(0);
            $this->body($stream->read($stream->length()));
        }
    }
    
}