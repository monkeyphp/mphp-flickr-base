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

    public function testGetStorage()
    {
        $results = $this->getResults();
        $parameters = $this->getParameters();
        $resultSetAdapter = $this->getMock('MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter', array('getResultDomNodeListQuery'), array($results, $parameters), 'Mock', true, true, true, true);
        $resultSetAdapter->expects($this->once())
                ->method('getResultDomNodeListQuery')
                ->will($this->returnValue('/rsp/photos/photo'));

        $this->assertInstanceOf('MphpFlickrBase\Adapter\Xml\ResultSet\AbstractResultSetAdapter', $resultSetAdapter);

        $reflectionObject = new \ReflectionObject($resultSetAdapter);
        $reflectionMethod = $reflectionObject->getMethod('getStorage');
        $reflectionMethod->setAccessible(true);
        $this->assertInstanceOf('SplFixedArray', $reflectionMethod->invoke($resultSetAdapter));
    }

    /**
     * Helper method
     *
     * @return array
     */
    protected function getParameters()
    {
        return array(
            'method'   => 'flickr.photos.search',
            'per_page' => 100,
            'page'     => 1,
            'tags'     => array('metallica'),
            'extras'   => array('description','license','date_upload','date_taken','owner_name','icon_server','original_format',
                'last_update','geo','tags','o_dims','views','media','path_alias','url_sq','url_t','url_s','url_q','url_m',
                'url_n','url_z','url_c','url_o')
        );
    }

    /**
     * Helper method to load results from file
     *
     * @return string
     */
    protected function getResults()
    {
        $results = file_get_contents('data/resultset.xml');
        return $results;
    }
}