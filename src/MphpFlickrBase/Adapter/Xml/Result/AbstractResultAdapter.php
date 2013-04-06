<?php
/**
 * AbstractResultSet.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Xml\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Adapter\Xml\Result;

use DOMDocument;
use DOMXPath;
use RuntimeException;

/**
 * AbstractResult
 *
 * Base Xml Result class providing a base implementation of a Result Adapter
 * designed for working with the Xml results returned from the Flickr api
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Xml\Result
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 * @abstract
 */
abstract class AbstractResultAdapter extends \MphpFlickrBase\Adapter\AbstractResultAdapter
{

    /**
     * DOMXPath query string used to retrieve the stat value
     *
     * @var string
     */
    protected $statQuery = '/rsp/@stat';

    /**
     * DOMXPath query string used to retrieve the error code
     *
     * @var string
     */
    protected $errCodeQuery  = '/rsp/err/@code';

    /**
     * DOMXPath query string used to retrieve the error message
     *
     * @var string
     */
    protected $errMsgQuery = '/rsp/err/@msg';

    /**
     * DOMXPath instance used to query the \DOMDocument instance
     *
     * @var DOMXPath
     */
    protected $domXPath;

    /**
     * Return the DOMXPath query string used to retrieve the stat value
     *
     * @return string
     */
    protected function getStatQuery()
    {
        return $this->statQuery;
    }

    /**
     * Return the DOMXPath query string used to retrieve the err code value
     *
     * @return string
     */
    protected function getErrCodeQuery()
    {
        return $this->errCodeQuery;
    }

    /**
     * Return the DOMXPath query string used to retrieve the err msg value
     *
     * @return string
     */
    protected function getErrMsgQuery()
    {
        return $this->errMsgQuery;
    }

    /**
     * Return the err code value
     *
     * An Xml implementation of {@link \MphpFlickrBase\Adapter\Interfaces\ResultAdapterInterface::getErrCode()}
     *
     * @return string|null
     */
    public function getErrCode()
    {
        if (! isset($this->errCode)) {
            $this->errCode = (($nodeList = $this->getDomXPath($this->getDomDocument())->query($this->getErrCodeQuery())) && $nodeList->length)
                ? $nodeList->item(0)->value
                : null;
        }
        return $this->errCode;
    }

    /**
     * Return the err msg value
     *
     * An Xml implementation of {@link \MphpFlickrBase\Adapter\Interfaces\ResultAdapterInterface::getErrMsg()}
     *
     * @return string|null
     */
    public function getErrMsg()
    {
        if (! isset($this->errMsg)) {
            $this->errMsg = (($nodeList = $this->getDomXPath($this->getDomDocument())->query($this->getErrMsgQuery())) && $nodeList->length)
                ? $nodeList->item(0)->value
                : null;
        }
        return $this->errMsg;
    }

    /**
     * Return the stat value
     *
     * An Xml implementation of {@link \MphpFlickrBase\Adapter\Interfaces\ResultAdapterInterface::getStat()}
     *
     * @return string|null
     */
    public function getStat()
    {
        if (! isset($this->stat)) {
            $this->stat = (($nodeList = $this->getDomXPath($this->getDomDocument())->query($this->getStatQuery())) && $nodeList->length)
                ? $nodeList->item(0)->value
                : null;
        }
        return $this->stat;
    }

    /**
     * Return an instance of DOMXPath for querying the supplied DOMDocument with
     *
     * @param DOMDocument $domDocument The DOMDocument instance to create a DOMXPath instance for
     *
     * @return DOMXPath
     */
    protected function getDomXPath(DOMDocument $domDocument)
    {
        if (! isset($this->domXPath)) {
            $this->domXPath = new DOMXPath($domDocument);
        }
        return $this->domXPath;
    }

    /**
     * To access to results xml data, instances of ResultSet use DOMDocument
     *
     * @throws RuntimeException
     * @return DOMDocument
     */
    protected function getDomDocument()
    {
        if (! isset($this->domDocument)) {

            $domDocument = new DOMDocument();

            if (! @$domDocument->loadXML($this->getResults())) {
                throw new RuntimeException('The xml results could not be loaded');
            }

            $this->domDocument = $domDocument;
        }
        return $this->domDocument;
    }

}