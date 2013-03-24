<?php
/**
 * ResultSetInterface.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\ResultSet;

/**
 * ResultSetInterface
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
interface ResultSetInterface extends \Iterator
{
    
    /**
     * Set the ResultAdapterInterface instance that this Result instance will
     * use to access the data retrieved from the Flickr api
     * 
     * @param ResultAdapterInterface $adapter
     * 
     * @return ResultInterface
     */
    public function setAdapter(\MphpFlickrBase\Adapter\Interfaces\ResultSet\ResultSetAdapterInterface $adapter);
    
    /**
     * Return the ResultAdapterInterface
     * 
     * @return ResultAdapterInterface
     */
    public function getAdapter();
    
}