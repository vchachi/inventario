<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\products;

class UpdateProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automated Products Updated from private api';

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
        $product = new products();
        $product->downloadAndSave();
        $this->info('Products updated successfully!');
    }
}
