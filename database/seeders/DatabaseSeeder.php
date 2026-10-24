<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user (email/password come from .env)
        $admin = User::firstOrNew(['email' => env('ADMIN_LOGIN_EMAIL', 'admin@example.com')]);
        $admin->name = 'Admin';
        $admin->password = env('ADMIN_PASSWORD', 'change-me-123');
        $admin->is_admin = true;
        $admin->save();

        // Sample categories + products (edit/delete them from the admin panel)
        $cats = [];
        foreach (['Clothing', 'Bags', 'Accessories'] as $name) {
            $cats[$name] = Category::firstOrCreate(['slug' => Str::slug($name)], ['name' => $name]);
        }

        $samples = [
            ['Cotton Panjabi', 'Clothing', 1850], ['Printed T-Shirt', 'Clothing', 650],
            ['Linen Shirt', 'Clothing', 1450], ['Denim Jacket', 'Clothing', 2900],
            ['Leather Backpack', 'Bags', 2400], ['Canvas Tote Bag', 'Bags', 700],
            ['Handmade Jute Bag', 'Bags', 950], ['Laptop Sleeve', 'Bags', 1200],
            ['Leather Wallet', 'Accessories', 850], ['Analog Watch', 'Accessories', 2200],
            ['Sunglasses', 'Accessories', 900], ['Woven Belt', 'Accessories', 550],
        ];

        foreach ($samples as [$name, $cat, $price]) {
            Product::firstOrCreate(['slug' => Str::slug($name)], [
                'category_id' => $cats[$cat]->id,
                'name' => $name,
                'description' => 'Sample product. Edit this description from the admin panel.',
                'price' => $price,
                'stock' => 20,
            ]);
        }
    }
}
