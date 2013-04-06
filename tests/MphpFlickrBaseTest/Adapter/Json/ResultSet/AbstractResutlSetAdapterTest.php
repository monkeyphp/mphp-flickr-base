<?php
/**
 * AbstractResultSetAdapterTest.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Adapter\Json\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBaseTest\Adapter\Json\ResultSet;

/**
 * AbstractResutlSetAdapterTest
 *
 * http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=4a6e63627766bce0d91c42ba28cc665c&tags=metallica&extras=description%2C+license%2C+date_upload%2C+date_taken%2C+owner_name%2C+icon_server%2C+original_format%2C+last_update%2C+geo%2C+tags%2C+machine_tags%2C+o_dims%2C+views%2C+media%2C+path_alias%2C+url_sq%2C+url_t%2C+url_s%2C+url_q%2C+url_m%2C+url_n%2C+url_z%2C+url_c%2C+url_l%2C+url_o&format=json&nojsoncallback=1&api_sig=ac273f866ca5dc4ca6f5b53ce361f5fb
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Adapter\Json\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractResultSetAdapterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that we can construct an instance
     */
    public function test__construct()
    {
        $jsonResultSetAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Json\ResultSet\AbstractResultSetAdapter', array($this->getResults(), $this->getParameters()), 'JsonAbstractResultSetAdapter', true);
    }

    /**
     * Test that we can retrieve the errCode value
     *
     * http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=4a6e63627766bce0d91c42ba28cc665c&user_id=fftyf&tags=metallica&extras=description%2C+license%2C+date_upload%2C+date_taken%2C+owner_name%2C+icon_server%2C+original_format%2C+last_update%2C+geo%2C+tags%2C+machine_tags%2C+o_dims%2C+views%2C+media%2C+path_alias%2C+url_sq%2C+url_t%2C+url_s%2C+url_q%2C+url_m%2C+url_n%2C+url_z%2C+url_c%2C+url_l%2C+url_o&format=json&nojsoncallback=1&api_sig=8a7f3518e3e0f82801b42c9712595933
     */
    public function testErrCode()
    {
        $results = '{ "stat": "fail", "code": 2, "message": "Unknown user" }';
        $parameters = array('user_id' => 'fftyf');
        $jsonResultSetAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Json\ResultSet\AbstractResultSetAdapter', array($results, $parameters), 'JsonAbstractResultSetAdapter', true);

        // expects code 2
        $this->assertSame(2, $jsonResultSetAdapter->getErrCode());
    }

    /**
     * Test that we can retrieve the errMsg value
     */
    public function testGetErrMsg()
    {
        $results = '{ "stat": "fail", "code": 2, "message": "Unknown user" }';
        $parameters = array('user_id' => 'fftyf');
        $jsonResultSetAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Json\ResultSet\AbstractResultSetAdapter', array($results, $parameters), 'JsonAbstractResultSetAdapter', true);

        // expects Unknown user
        $this->assertSame('Unknown user', $jsonResultSetAdapter->getErrMsg());
    }

    /**
     * Test that we can retrieve the stat value
     */
    public function testGetStat()
    {
        $jsonResultSetAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Json\ResultSet\AbstractResultSetAdapter', array($this->getResults(), $this->getParameters()), 'JsonAbstractResultSetAdapter', true);

        // expects "ok"
        $this->assertSame(\MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface::STAT_OK, $jsonResultSetAdapter->getStat());
    }

    /**
     * Test that we can retrieve the is fail value
     */
    public function testIsFail()
    {
        $jsonResultSetAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Json\ResultSet\AbstractResultSetAdapter', array($this->getResults(), $this->getParameters()), 'JsonAbstractResultSetAdapter', true);

        // expects false
        $this->assertFalse($jsonResultSetAdapter->isFail());
    }

    /**
     * Test that we can retrieve the is ok value
     */
    public function testIsOk()
    {
        $jsonResultSetAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\Json\ResultSet\AbstractResultSetAdapter', array($this->getResults(), $this->getParameters()), 'JsonAbstractResultSetAdapter', true);

        // expects true
        $this->assertTrue($jsonResultSetAdapter->isOk());
    }

    /**
     * Test that calling getDecodedResults with a good JSON data set returns okay
     */
    public function testGetDecodedResultsErrorNone()
    {
        $results = '{ "foo": "bar", "eggs": "ham", "sugars": 2, "milk": true }';
        $parameters = array();

        $jsonResultSetAdapter = $this->getMockForAbstractClass(
            'MphpFlickrBase\Adapter\Json\ResultSet\AbstractResultSetAdapter',
            array($results, $parameters),
            'JsonAbstractResultSetAdapter',
            true);
        $reflectionObject = new \ReflectionObject($jsonResultSetAdapter);
        $reflectionMethod = $reflectionObject->getMethod('getDecodedResults');
        $reflectionMethod->setAccessible(true);

        $decodedResults = $reflectionMethod->invoke($jsonResultSetAdapter);

        $this->assertInstanceOf('array', $decodedResults);
    }

    /**
     * Test that passing invalid JSON to the ResultSetAdapter throws an Exception
     * 
     * @expectedException MphpFlickrBase\Exception\InvalidResponseException
     */
    public function testGetDecodedResultsErrorSyntax()
    {
        $results = '{ "foo": "bar", "eggs": "ham", "sugars": 2, "milk" true }';
        $parameters = array();

        $jsonResultSetAdapter = $this->getMockForAbstractClass(
            'MphpFlickrBase\Adapter\Json\ResultSet\AbstractResultSetAdapter',
            array($results, $parameters),
            'JsonAbstractResultSetAdapter',
            true);

        $reflectionObject = new \ReflectionObject($jsonResultSetAdapter);
        $reflectionMethod = $reflectionObject->getMethod('getDecodedResults');
        $reflectionMethod->setAccessible(true);

        $decodedResults = $reflectionMethod->invoke($jsonResultSetAdapter);
    }

    /**
     * Helper method
     *
     * @return string
     */
    protected function getResults()
    {
        return file_get_contents('data/resultset.json');
    }

    /**
     * Helper method
     *
     * @return array
     */
    protected function getParameters()
    {
        return array(
            'tags'   => 'metallica',
            'extras' => 'description, license, date_upload, date_taken, owner_name, icon_server, original_format, last_update, geo, tags, machine_tags, o_dims, views, media, path_alias, url_sq, url_t, url_s, url_q, url_m, url_n, url_z, url_c, url_l, url_o'
        );
    }

}