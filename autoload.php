<?php

/**
 * Lazy loader
 * @param  string $named_class    Instantiated namespace\classname
 */
function autoloader( $named_class ) {

    $arr_named_class = explode( '\\', $named_class );
    $class = end( $arr_named_class );

    $path = 'classes/';
    $extension = '.inc';

    $filename = $path . $class . $extension;

    include $filename;

}

spl_autoload_register( 'autoloader' );

ini_set( 'display_errors', '1' );
error_reporting( E_ALL );
