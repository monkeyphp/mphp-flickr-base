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

// use MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface;
use MphpFlickrBase\Adapter\Interfaces\ResultSet\ResultSetAdapterInterface;
use MphpFlickrBase\Result\AbstractResult;

/**
 * AbstractResultSet
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractResultSet extends AbstractResult implements \MphpFlickrBase\ResultSet\ResultSetInterface
{

    /**
     * Constructor
     *
     * @param \MphpFlickrBase\Adapter\Interfaces\ResultSet\ResultSetAdapterInterface $resultSetAdapterInterface
     *
     * @return void
     */
    public function __construct(ResultSetAdapterInterface $resultSetAdapterInterface)
    {
        $this->setAdapter($resultSetAdapterInterface);
    }

    /**
     * Return the name of the Result class that is returned through each iteration
     * of the ResultSet
     *
     * @return string
     */
    protected function getResultClass()
    {
        return $this->resultClass;
    }

    /**
     * Return an instance of \MphpFlickrBase\Result\AbstractResult
     *
     * @return AbstractResult
     */
    public function current()
    {
        /* @var $resultAdapter ResultAdapterInterface */
        $resultAdapter = $this->getAdapter()->current();
        $resultClass = $this->getResultClass();
        $result = new $resultClass($resultAdapter);
        return $result;
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
     * @return ResultSetAdapterInterface
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
     * @param ResultSetAdapterInterface $adapter The adapter instace
     *
     * @return \MphpFlickrBase\ResultSet\AbstractResultSet
     */
    public function setAdapter(ResultSetAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

}