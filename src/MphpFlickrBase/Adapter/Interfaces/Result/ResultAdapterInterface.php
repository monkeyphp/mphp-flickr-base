<?php
/**
 * ResultInterface.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Interfaces\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Adapter\Interfaces\Result;

/**
 * ResultInterface
 * 
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Interfaces\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
interface ResultAdapterInterface
{
    
    const STAT_FAIL = 'fail';
    
    const STAT_OK = 'ok';
    
    /**
     * Return the stat value of the results
     * 
     * @example "ok" or "fail"
     * 
     * @return string|null
     */
    public function getStat();
    
    /**
     * Return a boolean indicating if an error was retured
     * 
     * @return boolean
     */
    public function isFail();
    
    /**
     * Return the error code
     * 
     * Only applicable is isFail returns true
     * 
     * @return string|null
     */
    public function getErrCode();
    
    /**
     * Return the error message
     * 
     * Only appilcable if isFail returns true
     * 
     * @return string|null
     */
    public function getErrMsg();
    
    /**
     * Return the raw results (as returned by the Flickr api)
     *
     * @return mixed|null
     */
    public function getResults();

    /**
     * Return an array containing the parameters that were passed to the
     * Flickr api that resulted in the results
     *
     * @return array|null
     */
    public function getParameters();
    
}