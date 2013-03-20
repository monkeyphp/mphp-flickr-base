<?php
/**
 * AbstractResultSet.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Xml\ResultSet
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Adapter\Xml\ResultSet;

/**
 * AbstractResultSet
 *
 * Abstract Xml ResultSet adapter
 * 
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Adapter\Xml\ResultSet
 * @abstract
 */
class AbstractResultSetAdapter extends \MphpFlickrBase\Adapter\AbstractResultSetAdapter
{

    /**
     * Instance of SplFixedArray to store instances of
     * {@link \MphpFlickrBase\Adapter\Xml\Result\AbstractResultAdapter}
     *
     * As the ResultSet is iterated through, instances of AbstractResultAdapter
     * are put into the storage instance
     *
     * @var \SplFixedArray
     */
    protected $storage;

    /**
     * An instance of DOMNodeList containing the XML records for individual Result
     * instances
     *
     * @var \DOMNodeList
     */
    protected $resultDomNodeList;

    /**
     * Instance of \DOMDocument used to access the results retrieved from the 
     * Flickr api
     * 
     * @var \DOMDocument
     */
    protected $domDocument;

    /**
     * DOMXPath instance used to query the \DOMDocument instance
     * 
     * @var \DOMXPath
     */
    protected $domXPath;

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
     * @return string|null
     */
    public function getErrCode() 
    {
        if (! isset($this->errCode)) {
            $this->errCode = $this->getDomXPath($this->getDomDocument())->query($this->getErrCodeQuery())->item(0)->value;
        }
        return $this->errCode;
    }

    /**
     * Return the err msg value
     * 
     * @return string|null
     */
    public function getErrMsg() 
    {
        if (! isset($this->errMsg)) {
            $this->errMsg = $this->getDomXPath($this->getDomDocument())->query($this->getErrMsgQuery())->item(0)->value;
        }
        return $this->errMsg;
    }

    /**
     * Return the stat value
     * 
     * @return string|null
     */
    public function getStat()
    {
        if (! isset($this->stat)) {
            $this->stat = $this->getDomXPath($this->getDomDocument())->query($this->getStatQuery())->item(0)->value;
        }
        return $this->stat;
    }
    
    /**
     * Return a boolean indicating that the request to the Flickr api resulted in 
     * a fail
     * 
     * @return boolean
     */
    public function isFail() 
    {
        return $this->getStat() === \MphpFlickrBase\Adapter\Interfaces\Result\ResultSet::STAT_FAIL;
    }
    
    
    /**
     * Return an instance of \SplFixedArray configured to the length of the
     * ResultDomNodeList
     *
     * @return \SplFixedArray
     */
    protected function getStorage()
    {
        if (! isset($this->storage)) {
            $this->storage = new \SplFixedArray($this->getResultDomNodeList()->length);
        }
        return $this->storage;
    }

    /**
     * ResultSet instances iterate through lists of contained Results. The raw xml
     * results for those Results are retrieved from an instance of DOMNodeList
     *
     * @var \DOMNodeList
     */
    protected function getResultDomNodeList()
    {
        if (! isset($this->resultDomNodeList)) {
            $this->resultDomNodeList = $this->getDomXPath($this->getDomDocument())->query($this->getResultDomNodeListQuery());
        }
        return $this->resultDomNodeList;
    }

    /**
     * To access to results xml data, instances of ResultSet use DOMDocument
     *
     * @throws \RuntimeException
     * @return \DOMDocument
     */
    protected function getDomDocument()
    {
        if (! isset($this->domDocument)) {

            $domDocument = new DOMDocument();

            if (! @$domDocument->loadXML($this->getResults())) {
                throw new \RuntimeException('The xml results could not be loaded');
            }

            $this->domDocument = $domDocument;
        }
        return $this->domDocument;
    }

    /**
     * Return the DOMXPath query string that will be used to query the
     * DOMDocument for the data for the Result adapters
     *
     * @throws \RuntimeException
     * @return string
     */
    protected function getResultDomNodeListQuery()
    {
        if (! isset($this->resultDomNodeListQuery)) {
            throw new \RuntimeException('Did you set the dom node list query string?');
        }
        return $this->resultDomNodeListQuery;
    }

    /**
     * Return an instance of DOMXPath for querying the supplied DOMDocument with
     *
     * @param \DOMDocument $domDocument The DOMDocument instance to create a DOMXPath instance for
     *
     * @return \DOMXPath
     */
    protected function getDomXPath(\DOMDocument $domDocument)
    {
        if (! isset($this->domXPath)) {
            $this->domXPath = new \DOMXPath($domDocument);
        }
        return $this->domXPath;
    }

    /**
     * Return the name of the ResultAdapter class
     *
     * @return string
     */
    protected function getResultAdapterClass()
    {
        return $this->resultAdapterClass;
    }

    /**
     * Iterator interface implementation
     *
     * @return ResultAdapter
     */
    public function current()
    {
        if (! $this->getStorage()->offsetExists($this->position)) {
            $xml = $this->getDomDocument()->saveXml($this->getResultDomNodeList()->item($this->position));
            $resultAdapterClass = $this->getResultAdapterClass();
            $resultAdapter = new $resultAdapterClass($xml, $this->getParameters());
            $this->getStorage()->offsetSet($this->position, $resultAdapter);
        }
        return $this->getStorage()->offsetGet($this->position);
    }

    /**
     * Iterator interface implementation
     *
     * @return boolean
     */
    public function valid()
    {
        return ($this->position < $this->getResultDomNodeList()->length);
    }

    

}