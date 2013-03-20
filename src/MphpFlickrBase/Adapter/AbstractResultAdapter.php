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
     * Constructor
     * 
     * @param mixed|string $results    The results as returned from Flickr api
     * @param mixed|array  $parameters The query parameters sent to the Flickr api
     * 
     * @return void
     */
    public function __construct($results, $parameters)
    {
        $this->setResults($results);
        $this->setParameters($parameters);
    }
    
    /**
     * Set the results property
     * 
     * @param mixed|string $results The results as retured from the Flickr api
     * 
     * @return \MphpFlickrBase\Adapter\AbstractResultAdapter
     */
    protected function setResults($results)
    {
        $this->results = $results;
        return $this;
    }
    
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
     * Set the parameters
     * 
     * @param array $parameters The parameters used to query the Flickr api with
     * 
     * @return \MphpFlickrBase\Adapter\AbstractResultAdapter
     */
    protected function setParamters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
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

    /**
     * Return a boolean indicating that the request to the Flickr api resulted in 
     * a fail
     * 
     * @return boolean
     */
    public function isFail() 
    {
        return $this->getStat() === \MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface::STAT_FAIL;
    }

    /**
     * Return a boolean indicating that the request to the Flickr api is ok
     * 
     * @return boolean
     */
    public function isOk() 
    {
        return $this->getStat() === \MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface::STAT_OK;
    }

}