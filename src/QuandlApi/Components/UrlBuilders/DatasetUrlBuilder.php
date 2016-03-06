<?php

namespace Godjen99\QuandlApi\Components\UrlBuilders;

class DatasetUrlBuilder extends UrlBuilder
{
    protected $apiType = 'datasets';

    /**
     * Builds the URL needed for to query/download the data in a dataset object
     *
     * @param string $datasetCode
     * @return string
     */
    public function buildDataUrl(string $datasetCode): string
    {
        return $this->buildUrl($datasetCode, 'data');
    }

    /**
     * Builds the URL needed for to query/download the metadata in a dataset object
     *
     * @param $datasetCode
     * @return string
     */
    public function buildMetadataUrl($datasetCode): string
    {
        return $this->buildUrl($datasetCode, 'metadata');
    }

    /**
     * Builds the URL needed for to query/download the data and metadata in a dataset object
     *
     * @param $datasetCode
     * @return string
     */
    public function buildDataAndMetadataUrl($datasetCode): string
    {
        return $this->buildUrl($datasetCode);
    }

    /**
     * Builds the URL needed for to search for an individual dataset.
     *
     * @return string
     */
    public function buildSearchUrl(): string
    {
        return $this->buildUrl('');
    }

    /**
     * Builds the URL string.
     *
     * @inheritdoc
     */
    protected function buildUrl(string $datasetCode = '', string $datasetType = ''): string
    {
        $urlParts = [
            $this->buildBaseUrl(),
        ];

        if ($datasetCode) {
            $urlParts[] = $this->getDatabaseCode();
            $urlParts[] = $datasetCode;
            if ($datasetType) {
                $urlParts[] = $datasetType;
            }
        }

        return implode('/', $urlParts).'.'.$this->getDataReturnType();
    }
}