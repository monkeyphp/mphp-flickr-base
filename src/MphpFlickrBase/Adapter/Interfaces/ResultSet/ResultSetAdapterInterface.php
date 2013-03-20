<?php
/**
 * ResultSetInterface.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Interfaces\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Adapter\Interfaces\ResultSet;

/**
 * ResultSetInterface
 *
 * Interface implemented by all ResultSet classes
 * All resultset classes are iterable
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Interfaces\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
interface ResultSetAdapterInterface extends \Iterator
{

}