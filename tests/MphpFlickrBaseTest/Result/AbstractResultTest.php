<?php
/**
 * AbstractResultTest.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBaseTest\Result;

use PHPUnit_Framework_TestCase;

/**
 * AbstractResultTest
 *
 * @category   MphpFlickrBaseTest
 * @package    MphpFlickrBaseTest
 * @subpackage MphpFlickrBaseTest\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractResultTest extends PHPUnit_Framework_TestCase
{
    
    public function test__construct()
    {
        $resultAdapter = $this->getMockForAbstractClass('MphpFlickrBase\Adapter\AbstractResultAdapter', array(), 'ResultAdapter', false);
        $this->assertInstanceof('MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface', $resultAdapter);
        
        $result = $this->getMockForAbstractClass('MphpFlickrBase\Result\AbstractResult', array($resultAdapter), 'Result', true);
    }
    
}