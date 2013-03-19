<?php
/**
 * AbstractResult.php
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
 * AbstractResult
 * 
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractResult implements ResultAdapterInterface
{
    
    /**
     * Set the Adapter instance that this Result instance will retrieve its data from
     * 
     * @var \MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface
     */
    protected $adapter;
    
    /**
     * @return \MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface
     */
    public function getAdapter() 
    {
        return $this->adapter;
    }

    /**
     * Set the Adapter instance that this Result will retrieve its data from
     * 
     * @param \MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface $adapter
     * 
     * @return \MphpFlickrBase\Result\AbstractResult
     */
    public function setAdapter(\MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface $adapter) 
    {
        $this->adapter = $adapter;
        return $this;
    }    
}