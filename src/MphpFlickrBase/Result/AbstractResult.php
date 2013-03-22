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
 * @abstract
 */
abstract class AbstractResult implements ResultInterface
{

    /**
     * Constructor
     *
     * @param \MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface $resultAdapterInterface
     *
     * @return void
     */
    public function __construct(\MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface $resultAdapterInterface)
    {
        $this->setAdapter($resultAdapterInterface);
    }

    /**
     * Set the Adapter instance that this Result instance will retrieve its data from
     *
     * @var \MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface
     */
    protected $adapter;

    /**
     * Return the ResultAdapterInterface
     *
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