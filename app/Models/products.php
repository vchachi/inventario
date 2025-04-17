<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

/**
 * Class products
 * @package App\Models
 * @version March 18, 2023, 2:59 am UTC
 *
 * @property string $title
 * @property integer $category_id
 * @property string $brand
 * @property string $model
 * @property string $color
 * @property string $bar_code
 * @property string $reference
 * @property integer $units
 * @property number $buy_price
 * @property number $sell_price
 * @property integer $invoicing
 * @property integer $state
 * @property integer $storage
 * @property integer $warranty
 * @property string $observations
 */
class products extends Model
{
    use HasFactory;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];

    protected $apiEndpoint = "https://recambiostablet.com/api/products/";
    protected $apiKey = 'SH77B9WW89CVEVS5TQ8HV4Y9HKG5GH1B';

    public $fillable = [
        'title',
        'category_id',
        'brand',
        'model',
        'color',
        'bar_code',
        'reference',
        'units',
        'buy_price',
        'id_shopify',
        'id_woocomerce',
        'sell_price',
        'invoicing',
        'state',
        'storage',
        'warranty',
        'observations',
        'id_user_master',
        'id_repairs'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'category_id' => 'integer',
        'brand' => 'string',
        'model' => 'string',
        'color' => 'string',
        'bar_code' => 'string',
        'reference' => 'string',
        'units' => 'integer',
        'buy_price' => 'double',
        'sell_price' => 'double',
        'invoicing' => 'integer',
        'id_shopify'=>'string',
        'id_woocomerce'=>'string',
        'state' => 'integer',
        'storage' => 'integer',
        'warranty' => 'integer',
        'observations' => 'string',
        'id_user_master' => 'integer',
        'id_repairs'=> 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       
    ];

    public function downloadAndSave()
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

            $cat_id = $data->product->id_category_default[0]->__toString();
            $units = $data->product->unit_price_ratio[0]->__toString();
            $buy_price = $data->product->price[0]->__toString();
            $sell_price = $data->product->wholesale_price[0]->__toString();

            $product = new products();
            // Set other attributes as needed
            $product->id = (int) $data->product->id;
            $product->title = $data->product->name->language[0][0]->__toString();
            $product->category_id = (int) $cat_id;
            $product->brand = 'default-brand';
            $product->model = 'default-model';
            $product->color = 'default-color';
            $product->bar_code = 'default-bar_code';
            $product->reference = $data->product->reference[0]->__toString();
            $product->units = (int) $units;
            $product->buy_price = (double) $buy_price;
            $product->sell_price = (double) $sell_price;
            $product->invoicing = (int) '1';
            $product->state = (int) '1';
            $product->storage = (int) '1';
            $product->warranty = (int) '1';
            $product->observations = $data->product->meta_description->language[1][0]->__toString();
            $product->save();
        }
    }
    
}
