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
    
    public function setAdapter(\MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface $adapter);
    
    public function getAdapter();
    
}