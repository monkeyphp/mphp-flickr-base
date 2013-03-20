<?php
/**
 * AbstractResultAdapterTest.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Adapter
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBaseTest\Adapter;

/**
 * AbstractResultAdapterTest
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Adapter
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractResultAdapterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that we can construct an instance of \MphpFlickrBase\Adapter\AbstractResultAdapter
     *
     * @covers MphpFlickrBase\Adapter\AbstractResultAdapter::__construct()
     * @covers MphpFlickrBase\Adapter\AbstractResultAdapter::setParameters()
     * @covers MphpFlickrBase\Adapter\AbstractResultAdapter::setResults()
     */
    public function test__construct()
    {
        $results = array();
        $parameters = array();
        $resultAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\AbstractResultAdapter', array($results, $parameters), 'ResultAdapter', true, false, true, array());
    }

}