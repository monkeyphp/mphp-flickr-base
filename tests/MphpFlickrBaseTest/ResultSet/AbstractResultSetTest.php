<?php
/**
 * AbstractResultSetTest.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBaseTest\ResultSet;

/**
 * AbstractResultSetTest
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractResultSetTest extends \PHPUnit_Framework_TestCase
{
    
    public function test__construct()
    {
        $resultSetAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\AbstractResultSetAdapter', array(), 'ResultSetAdapter', false);
        $this->assertInstanceof('MphpFlickrBase\Adapter\Interfaces\ResultSet\ResultSetAdapterInterface', $resultSetAdapter);
        
        $resultSet = $this->getMockForAbstractClass('MphpFlickrBase\ResultSet\AbstractResultSet', array($resultSetAdapter), 'ResultSet', true);
        
        $this->assertSame($resultSetAdapter, $resultSet->getAdapter());
    }
    
}