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
     * Instance of AdapterFactoryInterface
     *
     * @var \MphpFlickrBase\Adapter\Factory\AdapterFactoryInterface
     */
    protected $adapterFactory;

    /**
     * The classname of the AdpaterFactoryInterface instance
     *
     * @var string
     */
    protected $adapterFactoryClassname;

    /**
     * The Flickr api key
     *
     * @var string
     */
    protected $apiKey;

    /**
     * (Required) API application key
     *
     * @link http://www.flickr.com/services/api/misc.api_keys.html
     *
     * @var string
     */
    protected $argumentApiKey = 'api_key';

    /**
     * Url parameter format value
     *
     * @link http://www.flickr.com/services/api/response.rest.html
     *
     * @var string
     */
    protected $argumentFormat = 'format';

    /**
     * Required method name to pass to Flickr api
     *
     * @var string
     */
    protected $argumentMethod = 'method';

    /**
     * The default response format to request
     *
     * Defautls to Xml rest
     *
     * @var string
     */
    protected $defaultFormat;

    /**
     * Instance of \Zend\Http\Client that this Connector uses to
     * communicate with the Flickr api
     *
     * @var \Zend\Http\Client
     */
    protected $httpClient;

    /**
     * The Flick api method that this Connector instance
     * connects to
     *
     * Should be overridden in subclasses
     *
     * @var string
     */
    protected $method;

    /**
     * The Flickr api service url
     *
     * @var string
     */
    protected $serviceUri = 'http://api.flickr.com/services/rest/';

    /**
     * Constructor
     *
     * Requires the apikey value. Optionally supply an instance of Zend\Http\Client,
     * although the Connector will create its own instance if one is not
     * supplied
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
     * Perform a request to the Flickr api
     *
     * @param array $parameters Array of parameters to supply to the Flickr api
     *
     * @throws \MphpFlickrBase\Exception @todo Decide on exception type thrown
     * @return \MphpFlickrBase\Adapter\Interfaces\ResultAdapterInterface|\MphpFlickrBase\Adapter\Interfaces\ResultSetAdapterInterface
     */
    public function dispatch($parameters = array())
    {
        try {
            // prepare the parameters
            $parameters = $this->prepareParameters($parameters);

            // retrieve an instance of \Zend\Http\Request configured with the
            // the service uri and the prepared parameters
            $request = $this->getRequest($this->getServiceUri(), $parameters);

            // retrieve an instance of \Zend\Http\Client
            $httpClient = $this->getHttpClient();

            // dispatch the request to the Flickr api and capture the
            // returned response
            $response = $httpClient->dispatch($request);

            // retrieve the body from the response
            $body = $response->getBody();

            // retrieve the format of the response from the parameters array
            // should contain a format key - if the format cannot be discovered
            // we throw an exception
            if (null === ($format = (array_key_exists($this->getArgumentFormat(), $parameters)) ? $parameters[$this->getArgumentFormat()] : null)) {
                throw new \MphpFlickrBase\Exception\UnknownResponseFormatException();
            }

            // based on the format construct an instance of the appropriate
            // Adapter class (based on the response format) - defaults to Xml
            // supply the factory the response body (containing the results)
            // and the parameters used to make the request to the Flickr api
            $adapter = $this->getAdapterFactory()->makeAdapter($format, $body, $parameters);

            // inspect the adapter to check if the request to the Flickr api
            // was successful - if not we need to throw an Exception
            if ($adapter->isFail()) {
                return new \MphpFlickrBase\Exception\FailResultException($adapter->getErrMsg() . '(' . $adapter->getErrCode(). ')');
            }

            // finally return the adapter instance
            return $adapter;

        } catch(\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Return an instance of AdapterFactoryInterface
     *
     * @return \MphpFlickBase\Adapter\Factory\AdapterFactoryInterface
     */
    protected function getAdapterFactory()
    {
        if (! isset($this->adapterFactory)) {
            $adapterFactoryClassname = $this->getAdapterFactoryClassname();
            $adapterFactory = new $adapterFactoryClassname();
            $this->adapterFactory = $adapterFactory;
        }
        return $this->adapterFactory;
    }

    /**
     * Return the classname of the AdapterFactoryInterface instance
     *
     * @throws \RuntimeException
     * @return string
     */
    protected function getAdapterFactoryClassname()
    {
        if (! isset($this->adapterFactoryClassname)) {
            throw new \RuntimeException('Did you set the adapterFactoryClassname property?');
        }
        return $this->adapterFactoryClassname;
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
     * Return the argument api key value
     *
     * @return string
     */
    protected function getArgumentApiKey()
    {
        return $this->argumentApiKey;
    }

    /**
     * Return the url parameter format value
     *
     * @return string
     */
    protected function getArgumentFormat()
    {
        return $this->argumentFormat;
    }

    /**
     * Return the argument merhod key value
     *
     * @return string
     */
    protected function getArgumentMethod()
    {
        return $this->argumentMethod;
    }

    /**
     * Return the default format value
     *
     * @return string
     */
    protected function getDefaultFormat()
    {
        if (! isset($this->defaultFormat)) {
            $this->defaultFormat = $this->getAdapterFactory()->getDefaultFormat();
        }
        return $this->defaultFormat;
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
     * Return the method that this Connector will call
     *
     * @return string
     */
    protected function getMethod()
    {
        if (! isset($this->method)) {
            throw new \RuntimeException('Method not specified');
        }
        return $this->method;
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

    /**
     * Return the name of the Result/ResultSet class
     *
     * The $resultClass property should be declared in subclasses
     *
     * @return string
     */
    protected function getResultClass()
    {
        if (! isset($this->resultClass)) {
            throw new \RuntimeException('ResultClass not specified');
        }
        return $this->resultClass;
    }

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
     * Return an array of valid format values
     *
     * This method makes a call to the AdapterFactory for an array of formats
     * that it supports
     *
     * @return array
     */
    protected function getValidFormats()
    {
        return $this->getAdapterFactory()->getFormats();
    }

    /**
     * Validate and filter the supplied parameters
     *
     * The abstract connector implementation only adds the api_key value and
     * the method value to the parameters array. Sub classes of the abstract
     * Connector should provide the validation and filtering for the values
     * that the api end point they connect to implement.
     *
     * @param array $parameters Array of parameters to send to the Flickr api
     *
     * @return array
     */
    protected function prepareParameters($parameters = array())
    {
        // merge in the api_key value
        $parameters[$this->getArgumentApiKey()] = $this->getApiKey();

        // merge in the method
        $parameters[$this->getArgumentMethod()] = $this->getMethod();

        // merge in the format
        $parameters[$this->getArgumentFormat()] = $this->getDefaultFormat();

        // return the parameters
        return $parameters;
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
     * Validate the api key value
     *
     * @param mixed $value The value to validate
     *
     * @return boolean
     */
    protected function validateApiKey($value)
    {
        return is_string($value);
    }

    /**
     * Validate the format value
     *
     * @param mixed $value The value to validate
     *
     * @return boolean
     */
    protected function validateFormat($value)
    {
        return in_array($value, $this->getValidFormats());
    }

    /**
     * Validate the method value
     *
     * @param mixed $value The value to validate
     *
     * @return boolean
     */
    protected function validateMethod($value)
    {
        return is_string($value);
    }

}