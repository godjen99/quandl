<?php

namespace Godjen99\QuandlApi\Tests\Unit\Components\UrlBuilders;

use Godjen99\QuandlApi\Components\UrlBuilders\DatasetUrlBuilder;

class DatasetUrlBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var DatasetUrlBuilder */
    protected $urlBuilder;

    public function setUp()
    {
        parent::setUp();
        $this->urlBuilder = new DatasetUrlBuilder();
    }

    public function test_data_url_with_default_database_code_and_default_return_type()
    {
        $datasetCode = '12345';
        $this->assertEquals(
            'https://www.quandl.com/api/v3/datasets/'.$this->urlBuilder->getDatabaseCode()
                .'/'.$datasetCode.'/data.'.$this->urlBuilder->getDataReturnType(),
            $this->urlBuilder->buildDataUrl($datasetCode)
        );
    }

    public function test_metadata_url_with_default_database_code_and_default_return_type()
    {
        $datasetCode = '12345';
        $this->assertEquals(
            'https://www.quandl.com/api/v3/datasets/'.$this->urlBuilder->getDatabaseCode()
            .'/'.$datasetCode.'/metadata.'.$this->urlBuilder->getDataReturnType(),
            $this->urlBuilder->buildMetadataUrl($datasetCode)
        );
    }

    public function test_data_and_metadata_url_with_default_database_code_and_default_return_type()
    {
        $datasetCode = '12345';
        $this->assertEquals(
            'https://www.quandl.com/api/v3/datasets/'.$this->urlBuilder->getDatabaseCode()
            .'/'.$datasetCode.'.'.$this->urlBuilder->getDataReturnType(),
            $this->urlBuilder->buildDataAndMetadataUrl($datasetCode)
        );
    }

    public function test_search_url_with_default_return_type()
    {
        $this->assertEquals(
            'https://www.quandl.com/api/v3/datasets.'.$this->urlBuilder->getDataReturnType(),
            $this->urlBuilder->buildSearchUrl()
        );
    }

    public function returnTypeDataProvider()
    {
        return [
            ['JSON'],
            ['CSV'],
            ['XML']
        ];
    }

    /** @dataProvider returnTypeDataProvider */
    public function test_return_types_can_be_changed($dataType)
    {
        $this->urlBuilder->{'setReturnType'.$dataType}();
        $this->assertEquals(
            'https://www.quandl.com/api/v3/datasets.'.strtolower($dataType),
            $this->urlBuilder->buildSearchUrl()
        );
    }

    public function test_can_change_database_code()
    {
        $code = 'GET123';
        $this->urlBuilder->setDatabaseCode($code);
        $this->assertStringStartsWith(
            'https://www.quandl.com/api/v3/datasets/'.$code.'/',
            $this->urlBuilder->buildDataUrl(123456)
        );
    }
    
    public function test_url_builder_can_be_constructed_with_a_given_database_code()
    {
        $code = 'Test789';
        $urlBuilder = new DatasetUrlBuilder($code);
        $this->assertStringStartsWith(
            'https://www.quandl.com/api/v3/datasets/'.$code.'/',
            $urlBuilder->buildDataUrl(123456)
        );
    }
}
