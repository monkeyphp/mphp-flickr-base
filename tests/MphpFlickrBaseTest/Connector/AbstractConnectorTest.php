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
        $apiKey = '0123456789';
        $connector = $this->getMockForAbstractClass('MphpFlickrBase\Connector\AbstractConnector', array($apiKey), 'AbstractConnector', true);
    }

    /**
     * Test that we can construct a Connector instance when we suppy a Http Client instance
     */
    public function test__constructWithHttpClient()
    {
        $apiKey = '0123456789';
        $httpClient = $this->getMock('Zend\Http\Client');
        $connector = $this->getMockForAbstractClass('MphpFlickrBase\Connector\AbstractConnector', array($apiKey, $httpClient), 'AbstractConnector', true);
    }

    /**
     * This isnt working quite as I had hoped
     */
    public function testPrepareParameters()
    {
        $apiKey = '0123456789';
        $connector = $this->getMockForAbstractClass('MphpFlickrBase\Connector\AbstractConnector', array($apiKey), 'AbstractConnector', true);

        $reflectionObject = new \ReflectionObject($connector);
        $reflectionMethod = $reflectionObject->getMethod('prepareParameters');
        $reflectionMethod->setAccessible(true);

        $parameters = array();
        $reflectionMethod->invoke($connector, $parameters);
    }
}