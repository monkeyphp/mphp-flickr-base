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
     * Test that we can create a mock of the AbstractResultAdapter
     */
    public function testCanConstructInstance()
    {
        $resultSet = $this->getMock('MphpFlickrBase\Adapter\AbstractResultAdapter');
        $this->assertInstanceOf('MphpFlickrBase\Adapter\AbstractResultAdapter', $resultSet);
    }

}