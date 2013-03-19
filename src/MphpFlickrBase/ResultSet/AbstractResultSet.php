<?php
/**
 * AbstractResultSet.php
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
 * AbstractResultSet
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractResultSet extends \MphpFlickrBase\Result\AbstractResult implements \MphpFlickrBase\ResultSet\ResultSetInterface
{
    
    /**
     * Return an instance of \MphpFlickrBase\Result\AbstractResult
     * 
     * @return \MphpFlickrBase\Result\AbstractResult
     */
    public function current() 
    {
        /* @var $adapter \MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface */
        $adapter = $this->getAdapter()->current();
        
        //@todo return an instance of AbstractResult($adapter)
    }

    /**
     * Iterator interface
     * 
     * @return void
     */
    public function key() 
    {
        return $this->getAdapter()->key();
    }

    /**
     * Iterator interface
     * 
     * @return void
     */
    public function next() 
    {
        return $this->getAdapter()->next();
    }

    /**
     * Iterator interface
     * 
     * @return void
     */
    public function rewind() 
    {
        return $this->getAdapter()->rewind();
    }

    /**
     * Iterator interface
     * 
     * @return boolean
     */
    public function valid() 
    {
        return $this->getAdapter()->valid();
    }

    /**
     * Return the Adapter instance that this ResultSet class uses to access data
     * 
     * @return \MphpFlickrBase\Adapter\Interfaces\ResultSet\ResultSetAdapterInterface
     */
    public function getAdapter() 
    {
        return $this->adapter;
    }

    /**
     * Set the adapter instance that this ResultSet uses to access data
     * 
     * Overrides method declared in \MphpFlickrBase\Result\ResultInterface and
     * defined in \MphpFlickrBase\Result\AbstractResult
     * 
     * @param \MphpFlickrBase\Adapter\Interfaces\ResultSet\ResultSetAdapterInterface $adapter The adapter instace
     * 
     * @return \MphpFlickrBase\ResultSet\AbstractResultSet
     */
    public function setAdapter(\MphpFlickrBase\Adapter\Interfaces\ResultSet\ResultSetAdapterInterface $adapter) 
    {
        $this->adapter = $adapter;
        return $this;
    }  
    
}