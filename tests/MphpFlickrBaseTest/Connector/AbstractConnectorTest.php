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
    public function test__construct()
    {
        $apiKey = '0123456789';
        $connector = $this->getMockForAbstractClass('MphpFlickrBase\Connector\AbstractConnector', array($apiKey), 'AbstractConnector', true);
    }

}