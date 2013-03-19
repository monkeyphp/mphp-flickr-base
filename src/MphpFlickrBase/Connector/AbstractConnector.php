<?php
/**
 * AbstractConnector.php
 *
 * PHP Version  PHP 5.3.10
 *
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Connector
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
namespace MphpFlickrBase\Connector;

/**
 * AbstractConnector
 * 
 * @category   MphpFlickrBase
 * @package    MphpFlickrBase
 * @subpackage MphpFlickrBase\Connector
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 */
abstract class AbstractConnector implements ConnectorInterface
{
    
    /**
     * The Flickr api key
     * 
     * @var string
     */
    protected $apiKey;
    
    /**
     * The Flick api method that this Connector instance
     * connects to
     * 
     * @var string
     */
    protected $method;
    
    /**
     * Instance of \Zend\Http\Client that this Connector uses to 
     * communicate with the Flickr api
     * 
     * @var \Zend\Http\Client
     */
    protected $httpClient;
    
    /**
     * The Flickr api service url
     * 
     * @var string
     */
    protected $serviceUri = 'http://api.flickr.com/services/rest/';
    
    /**
     * Return the Flickr api service url
     * 
     * @return string
     */
    protected function getServiceUri()
    {
        return $this->serviceUri;
    }
    
    /**
     * Constructor
     * 
     * @param string            $apiKey     (Required) The api key 
     * @param \Zend\Http\Client $httpClient (Optional) Instance of \Zend\Http\Client
     * 
     * @return void
     */
    public function __construct($apiKey, \Zend\Http\Client $httpClient = null)
    {
        $this->setApiKey($apiKey);
        
        if (! is_null($httpClient)) {
            $this->setHttpClient($httpClient);
        }
    }
    
    /**
     * Return the method that this Connector will call
     * 
     * @return string
     */
    protected function getMethod()
    {
        return $this->method;
    }
    
    /**
     * Perform a request to the Flickr api
     * 
     * @param array $parameters
     * 
     * @throws \MphpFlickrBase\Connector\Exception
     * @return \MphpFlickrBase\Exception\FailResultException|\MphpFlickrBase\Connector\resultAdapterClass
     */
    public function dispatch($parameters = array()) 
    {
        try {
            
            $parameters = $this->prepareParameters();
            
            $request = $this->getRequest($this->getServiceUri(), $parameters);
            
            $httpClient = $this->getHttpClient();
            
            $response = $httpClient->dispatch($request);
            
            $body = $response->getBody();
            
            /* @var $resultAdapter \MphpFlickrBase\Adapter\Interfaces\Result\ResultAdapterInterface */
            $resultAdapterClass = $this->getResultAdapterClass();
            $resultAdapter = new $resultAdapterClass($body, $parameters);
            
            if ($resultAdapter->isFail()) {
                return new \MphpFlickrBase\Exception\FailResultException($resultAdapter->getErrMsg() . '(' . $resultAdapter->getErrCode(). ')');
            }
            
            return $resultAdapter;
            
        } catch(\Exception $exception) {
            throw $exception;
        }
    }
    
    /**
     * Validate and filter the supplied parameters
     * 
     * @param type $parameters
     * 
     * @return array
     */
    protected function prepareParameters($parameters = array())
    {
        return $parameters;
    }
    
    /**
     * Return the name of the Result/ResultSet adapter class
     * 
     * @return string
     */
    protected function getResultAdapterClass()
    {
        return $this->resultAdapterClass;
    }
    
    /**
     * Return the api key that this Connector will use when it
     * communicates with the Flickr api
     * 
     * @return string
     */
    protected function getApiKey()
    {
        return $this->apiKey;
    }
    
    /**
     * Set the api key that this Connector will use to communicate with
     * the Flickr api
     * 
     * @param string $apiKey The api key
     * 
     * @return \MphpFlickrBase\Connector\AbstractConnector
     */
    protected function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }
    
    /**
     * Return an instance of \Zend\Http\Client
     * 
     * @return \Zend\Http\Client
     */
    protected function getHttpClient()
    {
        if (! isset($this->httpClient)) {
            $this->httpClient = new \Zend\Http\Client();
        }
        return $this->httpClient;
    }
    
    /**
     * Set the instance of \Zend\Http\Client that this Connector will use
     * to communicate with the Flickr api
     * 
     * @param \Zend\Http\Client $httpClient The Client instance
     * 
     * @return \MphpFlickrBase\Connector\AbstractConnector
     */
    protected function setHttpClient(\Zend\Http\Client $httpClient)
    {
        $this->httpClient = $httpClient;
        return $this;
    }
    
    /**
     * Return an instance of \Zend\Http\Request configured with the supplied
     * parameters
     *
     * @param string $uri    The url to send the request to
     * @param array  $params Any url parameters
     * @param string $method The HTTP request method
     *
     * @return \Zend\Http\Request
     */
    protected function getRequest($uri, array $params = array(), $method = \Zend\Http\Request::METHOD_GET)
    {
        $request = new \Zend\Http\Request();
        $request->setUri($uri);
        $request->setMethod($method);
        $request->getQuery()->fromArray($params);

        return $request;
    }
    
}