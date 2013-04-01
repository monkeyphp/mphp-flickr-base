<?php
/**
 * AdapterFactoryInterface.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Factory
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Adapter\Factory;

/**
 * AdapterFactoryInterface
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Factory
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
interface AdapterFactoryInterface
{

    /**
     * Return an instance of \MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface or
     * \MphpFlickrBase\Adapter\Interfaces\ResultSet\ResultSetAdapterInterface
     *
     * @param string $format     The format of the Adapter to return
     * @param mixed  $results    The results to inject into the Adapter
     * @param mixed  $parameters The parameters to inject into the Adapter
     */
    public function makeAdapter($format, $results, $parameters);

    /**
     * Return an array of formats that this Factory supports
     *
     * @return array
     */
    public function getFormats();
    
}