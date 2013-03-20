<?php
/**
 * ResultInterface.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Result;

use MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface;

/**
 * ResultInterface
 * 
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
interface ResultInterface 
{
    
    /**
     * Set the ResultAdapterInterface instance that this Result instance will
     * use to access the data retrieved from the Flickr api
     * 
     * @param ResultAdapterInterface $adapter
     * 
     * @return ResultInterface
     */
    public function setAdapter(ResultAdapterInterface $adapter);
    
    /**
     * Return the ResultAdapterInterface
     * 
     * @return ResultAdapterInterface
     */
    public function getAdapter();
    
}