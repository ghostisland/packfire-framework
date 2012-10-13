<?php
namespace Packfire\Core\ClassLoader;

/**
 * IClassFinder interface
 * 
 * Provides interface for class finding
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Core\ClassLoader
 * @since 2.0.0
 */
interface IClassFinder {
    
    public function find($class);
    
}