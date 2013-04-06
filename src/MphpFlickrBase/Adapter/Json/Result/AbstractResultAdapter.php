<?php
/**
 * AbstractResultAdapter.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Json\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Adapter\Json\Result;

/**
 * AbstractResultAdapter
 *
 * http://www.php.net/manual/en/function.json-decode.php
 * http://www.php.net/manual/en/function.json-encode.php
 * http://www.php.net/manual/en/function.json-last-error.php
 * http://www.php.net/manual/en/json.constants.php
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Json\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
class AbstractResultAdapter extends \MphpFlickrBase\Adapter\AbstractResultAdapter
{

    /**
     * Json decoded results
     *
     * @var array|null
     */
    protected $decodedResults;

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

}