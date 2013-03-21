# MphpFlickrBase

A base library for accessing the Flickr api http://www.flickr.com/services/api/

[![Build Status](https://travis-ci.org/monkeyphp/mphp-flickr-base.png)](https://travis-ci.org/monkeyphp/mphp-flickr-base)

## Purpose

This Flickr client library provides base classes and interfaces for creating a
framework for accessing the Flickr api.

The framework is roughly split into three sections

* Connector
* Adapter
* Result and ResultSet

### Connector
At the core of the library are __connector__ classes which inherit from
\MphpFlickrBase\Connector\ConnectorInterface and \MphpFlickrBase\Connector\ConnectorAbstract.

Each Connector class, a loose implementation of the Service Connector pattern
(see Service Design Patterns by Robert Daigneau published by Addison Wesley) connect
to Flickr methods such as [flickr.photos.search](http://www.flickr.com/services/api/flickr.photos.search.html).

The Connector classes have a dependency on the Zend\Http library.

The Connector classes expose a _dispatch_ method which will return an instance of
an Adapter.

### Adapter
At the core of the Adapter subpackage are the Interfaces which provide the public
interface for accessing the data returned from the Flickr api.

There are two types of Adapter Interface -
* Result - for accessing a single record
* ResultSet - an iterable for accessing a collection of Results

The concrete implementations of the Adapter Interfaces are specific to the data
format returned from the Flickr api (such as JSON or XML).

These concrete implementations can be found in the relavent sub directory of
the Adapter subpackage.

### Result and ResultSet
At the highest layer of the framework are the Result and ResultSet classes.
These accept a concrete implementation of an Adapter Interface as a constructor
parameter and provide a clean interface for accessing this Adapter.

Results and ResultSets may accept an Adapter irrespective of the format type of the
Adapter.

For example, a Result class may accept an Adapter designed for accessing
XML formatted data _OR_ an Adapter designed for accessing JSON data. The Result class
does not care, so long as the Adapter implements the correct Interface.

This means that the developer may specify whichever format of data they want
returning from the Flickr api, the high level Result and ResultSet classes will
still work as expected.

php -f apigen.php -- --source ../../../src/ --destination ../../../docs/ --php "no" --todo "yes" --source-code "yes" --main "MphpFlickrBase" --title "MphpFlickrBase"
