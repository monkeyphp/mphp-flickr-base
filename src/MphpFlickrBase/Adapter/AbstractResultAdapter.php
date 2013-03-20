<?php
/**
 * AbstractResultAdapter.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Adapter;

/**
 * AbstractResultAdapter
 * 
 * Abstract result adapter
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 * @abstract 
 */
abstract class AbstractResultAdapter implements \MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface
{

    /**
     * The stat of the result
     * 
     * @var string|null
     */
    protected $stat;
    
    /**
     *
     * @var string|null
     */
    protected $errCode;
    
    /**
     *
     * @var string|null
     */
    protected $errMsg;
    
    /**
     * Mixed collection of raw results as returned from the Flickr api
     *
     * @var mixed|null
     */
    protected $results;

    /**
     * The parameters that were supplied to the Flickr api that resulted in the
     * results
     *
     * @var array|mixed
     */
    protected $parameters;

    /**
     * Return the results
     *
     * @return array|mixed|null
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Return the parameters
     *
     * @return mixed|array|null
     */
    public function getParameters()
    {
        return $this->parameters;
    }

}