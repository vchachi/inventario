<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\parts;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class UpdatePartsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:parts';

    protected $apiEndpoint = "https://recambiostablet.com/api/products/";
    protected $apiKey = 'SH77B9WW89CVEVS5TQ8HV4Y9HKG5GH1B';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automated Parts Updated from private api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $response = Http::withHeaders([
            'Accept' => 'application/xml',
        ])->get($this->apiEndpoint, [
            'ws_key' => $this->apiKey,
        ]);
        $xmlData = $response->body();
        $xml = new SimpleXMLElement($xmlData);
        foreach ($xml->products->product as $productData) {
            $url = $this->apiEndpoint.$productData['id']."?ws_key={$this->apiKey}";
            $response = Http::get($url);
            $data = new SimpleXMLElement($response);
            $parts = parts::updateOrCreate(['id_repara'=> $data->product->id],[
                'name'=> $data->product->name->language[0][0]->__toString(),
                'url'=>'https://recambiostablet.com/'.$data->product->id.'-'.$data->product->link_rewrite->language[0][0]->__toString().'.html',
                'observations'=>$data->product->meta_description->language[0][0]->__toString(),
                'active'=>$data->product->active
            ]);
        }
        $this->info('parts updated successfully!');
    }
}
