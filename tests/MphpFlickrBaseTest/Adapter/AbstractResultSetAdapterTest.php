<?php
/**
 * AbstractResultSetAdapterTest.php
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
 * AbstractResultSetAdapterTest
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Adapter
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractResultSetAdapterTest extends \PHPUnit_Framework_TestCase
{
    
    public function test__construct()
    {
        $results = array();
        $parameters = array();
        $this->getMockForAbstractClass('MphpFlickrBase\Adapter\AbstractResultSetAdapter', array($results, $parameters), 'AbstractResultSetAdapter', true);
    }
}