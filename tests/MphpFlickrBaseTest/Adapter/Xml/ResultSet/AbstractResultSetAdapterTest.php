<?php
/**
 * AbstractResultSetAdapterTest.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Adapter\Xml\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBaseTest\Adapter\Xml\ResultSet;

/**
 * AbstractResultSetAdapterTest
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Adapter\Xml\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractResultSetAdapterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that we can construct an ResultAdapter with an error Xml string
     * and retrieve the stat value
     *
     * @covers MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter::getStat()
     * @covers MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter::getStatQuery()
     */
    public function testGetStat()
    {
        $stat = 'fail';
        $code = '105';
        $msg = 'Service currently unavailable';
        $result = '<?xml version="1.0" encoding="utf-8" ?><rsp stat="' . $stat .'"><err code="' . $code . '" msg="' . $msg . '" /></rsp>';
        $parameters = array('api_key' => '0123456789', 'method' => 'flickr.photos.search');

        $resultSetAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter', array($result, $parameters), 'XmlAbstractResultSetAdapter', true);

        $this->assertInstanceOf('MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter', $resultSetAdapter);
        $this->assertSame(\MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface::STAT_FAIL, $resultSetAdapter->getStat());
    }

    public function testErrCode()
    {
        $stat = 'fail';
        $code = '105';
        $msg = 'Service currently unavailable';
        $result = '<?xml version="1.0" encoding="utf-8" ?><rsp stat="' . $stat .'"><err code="' . $code . '" msg="' . $msg . '" /></rsp>';
        $parameters = array('api_key' => '0123456789', 'method' => 'flickr.photos.search');

        $resultSetAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter', array($result, $parameters), 'XmlAbstractResultSetAdapter', true);

        $this->assertInstanceOf('MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter', $resultSetAdapter);
        $this->assertSame($code ,$resultSetAdapter->getErrCode());
    }

    public function testErrMsg()
    {
        $stat = 'fail';
        $code = '105';
        $msg = 'Service currently unavailable';
        $result = '<?xml version="1.0" encoding="utf-8" ?><rsp stat="' . $stat .'"><err code="' . $code . '" msg="' . $msg . '" /></rsp>';
        $parameters = array('api_key' => '0123456789', 'method' => 'flickr.photos.search');

        $resultSetAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter', array($result, $parameters), 'XmlAbstractResultSetAdapter', true);

        $this->assertInstanceOf('MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter', $resultSetAdapter);
        $this->assertSame($msg, $resultSetAdapter->getErrMsg());
    }

    public function testIsFail()
    {
        $stat = 'fail';
        $code = '105';
        $msg = 'Service currently unavailable';
        $result = '<?xml version="1.0" encoding="utf-8" ?><rsp stat="' . $stat .'"><err code="' . $code . '" msg="' . $msg . '" /></rsp>';
        $parameters = array('api_key' => '0123456789', 'method' => 'flickr.photos.search');

        $resultSetAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter', array($result, $parameters), 'XmlAbstractResultSetAdapter', true);

        $this->assertInstanceOf('MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter', $resultSetAdapter);
        $this->assertTrue($resultSetAdapter->isFail());
    }

}