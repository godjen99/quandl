<?php

namespace Godjen99\QuandlApi\Components\UrlBuilders;

abstract class UrlBuilder
{
    /**
     * The version of the API to use.
     *
     * @var string
     */
    protected $apiVersion = 'v3';

    /**
     * The default database to query in Quandl.
     *
     * @var string
     */
    protected $databaseCode = 'WIKI';

    /**
     * @var string
     */
    protected $baseEndpoint = 'https://www.quandl.com/api';

    /**
     * The data type to return from the API calls.
     *
     * @var string
     */
    protected $dataReturnType = 'json';

    /**
     * Build an instance of the UrlBuilder class.
     *
     * @param string $databaseCode
     */
    public function __construct($databaseCode = '')
    {
        if ($databaseCode) {
            $this->databaseCode = $databaseCode;
        }
    }

    /**
     * Sets the database code to use in the URLs for the API.
     *
     * @param $code
     * @return UrlBuilder
     */
    public function setDatabaseCode($code): UrlBuilder
    {
        $this->databaseCode = $code;
        return $this;
    }

    /**
     * Sets the data return type to JSON; used in the URLs for the API.
     *
     * @return UrlBuilder
     */
    public function setReturnTypeJSON(): UrlBuilder
    {
        $this->dataReturnType = 'json';
        return $this;
    }

    /**
     * Sets the data return type to CSV; used in the URLs for the API.
     *
     * @return UrlBuilder
     */
    public function setReturnTypeCSV(): UrlBuilder
    {
        $this->dataReturnType = 'csv';
        return $this;
    }

    /**
     * Sets the data return type to XML; used in the URLs for the API.
     *
     * @return UrlBuilder
     */
    public function setReturnTypeXML(): UrlBuilder
    {
        $this->dataReturnType = 'xml';
        return $this;
    }

    /**
     * Gets the currently set database code.
     *
     * @return string
     */
    public function getDatabaseCode(): string
    {
        return $this->databaseCode;
    }

    /**
     * Gets the currently base code.
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseEndpoint;
    }

    /**
     * Gets the currently set API type (data, metadata, data and metadata and search).
     *
     * @return string
     */
    public function getApiType(): string
    {
        return $this->apiType;
    }

    /**
     * Gets the currently set API version.
     *
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * Gets the currently set data return type (json, xml, csv).
     *
     * @return string
     */
    public function getDataReturnType(): string
    {
        return $this->dataReturnType;
    }

    /**
     * Builds the base URL for use with the API.
     *
     * @return string
     */
    protected function buildBaseUrl(): string
    {
        $urlParts = [
            $this->getBaseUrl(),
            $this->getApiVersion(),
            $this->getApiType(),
        ];
        return implode('/', $urlParts);
    }

    /**
     * Creates a URL string.
     *
     * @param string $datasetCode
     * @param string $datasetType
     * @return string
     */
    abstract protected function buildUrl(string $datasetCode = '', string $datasetType = ''): string;
}