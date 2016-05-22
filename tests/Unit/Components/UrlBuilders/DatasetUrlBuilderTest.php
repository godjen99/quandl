<?php

namespace Godjen99\QuandlApi\Tests\Unit\Components\UrlBuilders;

use Godjen99\QuandlApi\Components\UrlBuilders\DatasetUrlBuilder;

class DatasetUrlBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var DatasetUrlBuilder */
    protected $urlBuilder;

    /** @var string */
    protected $baseUrl = 'https://www.quandl.com/api/v3/datasets';

    public function setUp()
    {
        parent::setUp();
        $this->urlBuilder = new DatasetUrlBuilder();
    }

    public function test_data_url_with_default_database_code_and_default_return_type()
    {
        $datasetCode = '12345';
        $this->assertEquals(
            $this->baseUrl.'/WIKI/12345/data.json',
            $this->urlBuilder->data($datasetCode)
        );
    }

    public function test_metadata_url_with_default_database_code_and_default_return_type()
    {
        $datasetCode = '12345';
        $this->assertEquals(
            $this->baseUrl.'/WIKI/12345/metadata.json',
            $this->urlBuilder->metadata($datasetCode)
        );
    }

    public function test_data_and_metadata_url_with_default_database_code_and_default_return_type()
    {
        $datasetCode = '12345';
        $this->assertEquals(
            $this->baseUrl.'/WIKI/12345.json',
            $this->urlBuilder->dataAndMetadata($datasetCode)
        );
    }

    public function test_search_url_with_default_return_type_json()
    {
        $this->assertContains('.json', $this->urlBuilder->search());
    }

    public function returnTypeDataProvider()
    {
        return [
            ['JSON'],
            ['CSV'],
            ['XML']
        ];
    }

    /**
     * @param string $dataType The data type to change to.
     * @dataProvider returnTypeDataProvider
     */
    public function test_return_types_can_be_changed($dataType)
    {
        $this->urlBuilder->{'setReturnType'.$dataType}();
        $this->assertStringEndsWith('.'.strtolower($dataType), $this->urlBuilder->search());
    }

    public function test_can_change_database_code()
    {
        $this->assertEquals('WIKI', $this->urlBuilder->getDatabaseCode());

        $code = 'GET123';
        $this->urlBuilder->setDatabaseCode($code);

        $this->assertEquals('GET123', $this->urlBuilder->getDatabaseCode());
    }
    
    public function test_url_builder_can_be_constructed_with_a_given_database_code()
    {
        $code = 'Test789';
        $urlBuilder = new DatasetUrlBuilder($code);

        $this->assertEquals('Test789', $urlBuilder->getDatabaseCode());
    }
}
