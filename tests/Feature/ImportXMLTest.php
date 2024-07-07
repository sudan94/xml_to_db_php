<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use App\Models\Item;


class ImportXMLTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test the import:xml command and check if the data is imported
     *
     * @return void
     */
    public function testImportXMLCommand()
    {
        $xmlPath = base_path('/feed/test_feed.xml');

        // Run the import command
        Artisan::call('import:xml ' . $xmlPath);

        // Check if the data is imported
        $this->assertDatabaseHas('items', [
            'entity_id' => 340,
        ]);
    }

    /**
     * Test the import:xml command with missing file
     *
     * @return void
     */
    public function testImportXMLCommandWithMissingFile()
    {
        $xmlPath = base_path('/feed/non_existent_file.xml');

        $exitCode = Artisan::call('import:xml ' . $xmlPath);
        $this->assertEquals(0, $exitCode); // Exit code should be 0
        $this->assertStringContainsString('File not found :', Artisan::output()); // Check if the error message is displayed
    }

    /**
     * Test the import:xml command with invalid XML
     *
     * @return void
     */
    public function testImportXMLCommandWithInvalidXML()
    {
        $xmlFilePath = base_path('/feed/test_feed_invalid.xml');

        $exitCode = Artisan::call('import:xml ' . $xmlFilePath);
        $this->assertEquals(0, $exitCode); // Exit code should be 0
        $this->assertStringContainsString('Error processing XML file : ', Artisan::output()); // Check if the error message is displayed
    }
}
