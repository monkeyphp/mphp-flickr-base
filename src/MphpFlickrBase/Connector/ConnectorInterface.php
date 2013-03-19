<?php
/**
 * ConnectorInterface.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Connector
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Connector;

/**
 * ConnectorInterface
 * 
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Connector
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
interface ConnectorInterface 
{
    
    /**
     * Dispatch a request to the Flickr api
     * 
     * @param array $parameters Array of parameters
     * 
     * @return mixed
     */
    public function dispatch($parameters = array());
    
}