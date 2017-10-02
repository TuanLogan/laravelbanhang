<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Slug;
use DB;
class GenerateProductSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:Generate-Product-Slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Product Slug';

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
     * @return mixed
     */
    public function handle()
    {
        $product = Product::all();
        foreach ($product as $p) {
            $slug = Slug::where([
                'entity_type' => $p->entityType,
                'entity_id' => $p->id
            ])->first();
            if($slug){
                continue;
            }
            $productSlug = slug_generate($p->name);
            DB::table('slugs')->insert([
                'entity_type' => $p->entityType,
                'entity_id' => $p->id,
                'slug' => $productSlug
            ]);
        }
    }
}
