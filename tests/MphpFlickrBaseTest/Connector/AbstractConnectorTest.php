<?php
/**
 * AbstractConnectorTest.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Connector
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBaseTest\Connector;

/**
 * AbstractConnectorTest
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Connector
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractConnectorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that we can construct a Connector instance
     */
    public function test__constructWithoutHttpClient()
    {
        $connector = $this->getMock('MphpFlickrBase\Connector\AbstractConnector', array(), array('0123456789'), 'AbstractConnector', true, true, true, true);
    }

    /**
     * Test that we can construct a Connector instance when we supply a Http Client instance
     */
    public function test__constructWithHttpClient()
    {
        $connector = $this->getMock('MphpFlickrBase\Connector\AbstractConnector', array(), array('0123456789', new \Zend\Http\Client), 'AbstractConnector', true, true, true, true);
    }

}