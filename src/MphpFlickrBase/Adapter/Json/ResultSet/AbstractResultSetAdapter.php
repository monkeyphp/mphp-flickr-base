<?php
/**
 * AbstractResultSet.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Json\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Adapter\Json\ResultSet;

/**
 * AbstractResultSetAdapter
 *
 * http://www.php.net/manual/en/function.json-decode.php
 * http://www.php.net/manual/en/function.json-encode.php
 * http://www.php.net/manual/en/function.json-last-error.php
 * http://www.php.net/manual/en/json.constants.php
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Json\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
abstract class AbstractResultSetAdapter extends \MphpFlickrBase\Adapter\AbstractResultSetAdapter
{

    /**
     * Instance of \SplFixedArray
     *
     * @var \SplFixedArray
     */
    protected $storage;

    /**
     * Json decoded results
     *
     * @var array|null
     */
    protected $decodedResults;

    /**
     *
     * @return \SplFixedArray
     */
    protected function getStorage()
    {
        if (! isset($this->storage)) {
            $this->storage = new \SplFixedArray(count($this->getResultList()));
        }
        return $this->storage;
    }

    abstract protected function getResultList();

    /**
     * {@link http://www.php.net/manual/en/function.json-last-error.php}
     *  //@todo  magic numbers
     * @return array
     */
    protected function getDecodedResults()
    {
        if (! isset($this->decodedResults)) {
            // if null then there has been an error
            if (null === ($decodedResults = json_decode($this->getResults(), true, 512))) {
                $jsonLastError = json_last_error();
                $exceptionMessage = '';
                switch ($jsonLastError) {
                    case JSON_ERROR_NONE:
                        $exceptionMessage = 'No error has occurred';
                        break;
                    case JSON_ERROR_STATE_MISMATCH:
                        $exceptionMessage = 'Invalid or malformed JSON';
                        break;
                    case JSON_ERROR_CTRL_CHAR:
                        $exceptionMessage = 'Control character error, possibly incorrectly encoded';
                        break;
                    case JSON_ERROR_SYNTAX:
                        $exceptionMessage = 'Syntax error';
                        break;
                    case JSON_ERROR_UTF8:
                        $exceptionMessage = 'Malformed UTF-8 characters, possibly incorrectly encoded';
                        break;
                    default:
                        $exceptionMessage = 'An unknown error occurred';
                }
                throw new \MphpFlickrBase\Exception\InvalidResponseException($exceptionMessage);
            }
            $this->decodedResults = $decodedResults;
        }
        return $this->decodedResults;
    }

    /**
     * Iterator interface
     */
    public function current()
    {
        if (! $this->storage()->offsetExists($this->position)) {
            $resultList = $this->getResultList();            // should return an array
            $resultArray = $resultList[$this->position];     // should return an array
            if (! $resultJson = json_encode($resultArray)) { // @todo look at options
                throw new \RuntimeException('Could not encode the data');
            }
            $resultAdapterClass = $this->getResultAdapterClass(); // return class name
            $resultAdapter = new $resultAdapterClass($resultJson, $this->getParameters());
            $this->getStorage()->offsetSet($this->position, $resultAdapter);
        }
        return $this->getStorage()->offsetGet($this->position);
    }

    /**
     * MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface interface
     *
     */
    public function getErrCode()
    {
        if (! isset($this->errCode)) {
            $decodedResults = $this->getDecodedResults();
            $this->errCode = ((array_key_exists('code', $decodedResults)))
                ? $decodedResults['code']
                : null;
        }
        return $this->errCode;
    }

    /**
     * MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface interface
     *
     */
    public function getErrMsg()
    {
        if (! isset($this->errMsg)) {
            $decodedResults = $this->getDecodedResults();
            $this->errMsg = ((array_key_exists('message', $decodedResults)))
                ? $decodedResults['message']
                : null;
        }
        return $this->errMsg;
    }

    /**
     * MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface interface
     *
     */
    public function getStat()
    {
        if (! isset($this->stat)) {
            $decodedResults = $this->getDecodedResults();
            $this->stat = ((array_key_exists('stat', $decodedResults)))
                ? $decodedResults['stat']
                : null;
        }
        return $this->stat;
    }

    /**
     * Iterator interface
     *
     * @return boolean
     */
    public function valid()
    {
        return ($this->position < count($this->getResultList()));
    }

}