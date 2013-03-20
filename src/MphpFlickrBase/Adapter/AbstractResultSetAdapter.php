<?php
/**
 * AbstractResultSetAdapter.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Adapter;

/**
 * AbstractResultSetAdapter
 *
 * Abstract adapter
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 * @abstract
 */
abstract class AbstractResultSetAdapter extends AbstractResultAdapter implements \MphpFlickrBase\Adapter\Interfaces\ResultSet\ResultSetAdapterInterface
{

    /**
     * Mixed collection of raw results as returned from the Flickr api
     *
     * @var mixed|null
     */
    protected $results;

    /**
     * The parameters that were supplied to the Flickr api that resulted in the
     * results
     *
     * @var array|mixed
     */
    protected $parameters;

    /**
     * Iterator interface position counter
     *
     * @var int
     */
    protected $position = 0;

    /**
     * Iterator interface
     * {@link http://www.php.net/manual/en/iterator.key.php}
     *
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Iterator interface
     * {@link http://www.php.net/manual/en/iterator.next.php}
     *
     * @return void
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Iterator interface
     * {@linkhttp://www.php.net/manual/en/iterator.rewind.php}
     *
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
    }

}