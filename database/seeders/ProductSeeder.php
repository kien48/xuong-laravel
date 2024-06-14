<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */




    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        Tag::query()->truncate();

        Tag::factory(15)->create();

        $sizes = ['S', 'M', 'L', 'XL'];
        $colors = ['#FF0000', '#00FF00', '#0000FF', '#FFFF00','#FFFFFF'];

        foreach ($sizes as $size){
            ProductSize::query()->create([
                'name' => $size
            ]);
        }

        foreach ($colors as $color){
            ProductColor::query()->create([
                'name' => $color
            ]);
        }

        for($i= 0; $i<1000;$i++){
            $name = fake()->text(50);
            Product::query()->create([
                'catelogue_id'=>fake()->numberBetween(9,11),
                'name'=>$name,
                'slug'=>Str::slug($name).'-'.Str::random(8),
                'sku'=>Str::random(8).$i,
                'img_thumbnail'=>"https://canifa.com/img/1000/1500/resize/8/t/8ts23s008-se297-1.webp",
                'price'=>699000,
                'sale_price'=>499000,
            ]);
        }

        for($i=1;$i<1001;$i++){
            ProductGallery::query()->insert([
                ['product_id'=>$i,'image'=>"https://canifa.com/img/1000/1500/resize/8/t/8ts23s008-se297-1.webp"],
                ['product_id'=>$i,'image'=>"https://canifa.com/img/1000/1500/resize/6/d/6ds24s019-sw011-l-1-u.webp"]
            ]);
        }

        for($i=1;$i<1001;$i++){
            DB::table('product_tags')->insert([
             [
                 'product_id' => $i,
                 'tag_id' => rand(1,8)
             ],
             [
             'product_id' => $i,
                'tag_id' => rand(9,15)
            ]
            ]);
        }

        for($productID =1;$productID<1001;$productID++){
            $data = [];
            for($sizeID=1;$sizeID<5;$sizeID++){
                for($colorID=1;$colorID<6;$colorID++){
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quantity' => 100,
                        'image'=>'https://canifa.com/img/1000/1500/resize/6/d/6ds24s019-sw011-l-1-u.webp'
                    ];
                }
            }
            DB::table('product_variants')->insert($data);
        }
    }
}
