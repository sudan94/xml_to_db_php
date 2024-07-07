<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Item;

class ImportXML extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:xml {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Items from XML file';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        //main function to import XML file
        $file = $this->argument('file');
        if (!file_exists($file)) {
            Log::error('File not found :' . $file);
            $this->error('File not found :' . $file);
            return;
        }
        try {
            $xml = simplexml_load_file($file);
            foreach ($xml->item as $item) {
                $existingItem = Item::where('entity_id', $item->entity_id)->first();
                if ($existingItem) {
                    Log::info("Item with entity_id {$item->entity_id} already exists. Skipping.");
                    continue;
                }
                if (empty($existingItem)) {
                    Item::create([
                        'entity_id' => (int) $item->entity_id,
                        'CategoryName' => (string) $item->CategoryName,
                        'sku' => (string) $item->sku,
                        'name' => (string) $item->name,
                        'description' => (string) $item->description,
                        'shortdesc' => (string) $item->shortdesc,
                        'price' => (float) $item->price,
                        'link' => (string) $item->link,
                        'image' => (string) $item->image,
                        'Brand' => (string) $item->Brand,
                        'Rating' => (int) $item->Rating,
                        'CaffeineType' => (string) $item->CaffeineType,
                        'Count' => (int) $item->Count,
                        'Flavored' => (string) $item->Flavored,
                        'Seasonal' => (string) $item->Seasonal,
                        'Instock' => (string) $item->Instock,
                        'Facebook' => (int) $item->Facebook,
                        'IsKCup' => (int) $item->IsKCup
                    ]);
                }
            }
            $this->info('Items imported successfully');
        } catch (\Exception $e) {
            Log::error("Error processing XML file : " . $e->getMessage());
            $this->error("Error processing XML file : " . $e->getMessage());
            return;
        }
    }
}
