<?php
/**
 * AbstractResultAdapterTest.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Adapter\Xml\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBaseTest\Adapter\Xml\Result;

/**
 * AbstractResultAdapterTest
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Adapter\Xml\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractResultAdapterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that we can construct an ResultAdapter with an error Xml string
     * and retrieve the stat value
     * 
     * @covers MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter::getStat()
     */
    public function testGetStat()
    {
        $stat = 'fail';
        $code = '105'; 
        $msg = 'Service currently unavailable';
        $xml = '<?xml version="1.0" encoding="utf-8" ?><rsp stat="$stat"><err code="$code" msg="$message" /></rsp>';
        $parameters = array('api_key' => '0123456789', 'method' => 'flickr.photos.search');
        
        $resultAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', array($xml, $parameters), 'AbstractResultAdapter', true);
        
        $this->assertInstanceOf('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', $resultAdapter);
        
        $this->assertTrue(\MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface::STAT_FAIL, $resultAdapter->isStat());
    }
    
    /**
     * Test that we can construct a ResultAdapter with an error Xml string
     * and retrieve the isFail boolean value
     * 
     * @covers MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter::isFail()
     */
    public function testIsFail()
    {
        $stat = 'fail';
        $code = '105'; 
        $msg = 'Service currently unavailable';
        $xml = '<?xml version="1.0" encoding="utf-8" ?><rsp stat="$stat"><err code="$code" msg="$message" /></rsp>';
        $parameters = array('api_key' => '0123456789', 'method' => 'flickr.photos.search');
        
        $resultAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', array($xml, $parameters), 'AbstractResultAdapter', true);
        
        $this->assertInstanceOf('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', $resultAdapter);
        
        $this->assertTrue($resultAdapter->isFail());
    }
    
    /**
     * Test that we can construct an instance of a ResultAdapter with an error
     * xml string and retrieve the errCode value
     * 
     * @covers MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter::getErrCode()
     */
    public function testGetErrCode()
    {
        $stat = 'fail';
        $code = '105'; 
        $msg = 'Service currently unavailable';
        $xml = '<?xml version="1.0" encoding="utf-8" ?><rsp stat="$stat"><err code="$code" msg="$message" /></rsp>';
        $parameters = array('api_key' => '0123456789', 'method' => 'flickr.photos.search');
        
        $resultAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', array($xml, $parameters), 'AbstractResultAdapter', true);
        
        $this->assertInstanceOf('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', $resultAdapter);
        
        $this->assertSame($code, $resultAdapter->getErrCode());
    }
    
    /**
     * Test that we can construct a ResultAdapter instance with an error xml string
     * and retrieve the errMsg value
     * 
     * @covers MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter::getErrMsg()
     */
    public function testGetErrMsg()
    {
        $stat = 'fail';
        $code = '105'; 
        $msg = 'Service currently unavailable';
        $xml = '<?xml version="1.0" encoding="utf-8" ?><rsp stat="$stat"><err code="$code" msg="$message" /></rsp>';
        $parameters = array('api_key' => '0123456789', 'method' => 'flickr.photos.search');
        
        $resultAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', array($xml, $parameters), 'AbstractResultAdapter', true);
        
        $this->assertInstanceOf('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', $resultAdapter);
        
        $this->assertSame($msg, $resultAdapter->getErrMsg());
    }
    
    /**
     * Test that we can retrieve the results value that the ResultAdapter instance
     * was constructed with
     * 
     * @covers MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter::getResults()
     */
    public function testGetResults()
    {
        $stat = 'fail';
        $code = '105'; 
        $msg = 'Service currently unavailable';
        $xml = '<?xml version="1.0" encoding="utf-8" ?><rsp stat="$stat"><err code="$code" msg="$message" /></rsp>';
        $parameters = array('api_key' => '0123456789', 'method' => 'flickr.photos.search');
        
        $resultAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', array($xml, $parameters), 'AbstractResultAdapter', true);
        
        $this->assertInstanceOf('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', $resultAdapter);
        
        $this->assertSame($results, $resultAdapter->getResults());
    }
    
    /**
     * Test that we can retrieve the parameter value that the ResultAdapter was 
     * constructed with
     * 
     * @covers MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter::getParameters()
     */
    public function testGetParameters()
    {
        $stat = 'fail';
        $code = '105'; 
        $msg = 'Service currently unavailable';
        $xml = '<?xml version="1.0" encoding="utf-8" ?><rsp stat="$stat"><err code="$code" msg="$message" /></rsp>';
        $parameters = array('api_key' => '0123456789', 'method' => 'flickr.photos.search');
        
        $resultAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', array($xml, $parameters), 'AbstractResultAdapter', true);
        
        $this->assertInstanceOf('MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter', $resultAdapter);
        
        $this->assertSame($parameters, $resultAdapter->getParameters());
    }
    
}