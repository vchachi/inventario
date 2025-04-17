<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

/**
 * Class categories
 * @package App\Models
 * @version March 20, 2023, 3:12 am UTC
 *
 * @property string $title
 */
class categories extends Model
{
    use HasFactory;

    public $table = 'categories';
    

    protected $dates = ['deleted_at'];

    protected $apiEndpoint = "https://recambiostablet.com/api/categories/";
    protected $apiKey = 'SH77B9WW89CVEVS5TQ8HV4Y9HKG5GH1B';


    public $fillable = [
        'title',
        'id_user_master'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
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

        foreach ($xml->categories->category as $categoryData) {

            $url = $this->apiEndpoint.$categoryData['id']."?ws_key={$this->apiKey}";
            $response = Http::withHeaders([
                'Accept' => 'application/xml',
            ])->get($url);
            $data = new SimpleXMLElement($response);

            $category = new categories();
            // Set other attributes as needed
            $category->id = (int) $data->category->id;
            $category->title = $data->category->name->language[0][0]->__toString();
            $category->save();
        }
    }
}
