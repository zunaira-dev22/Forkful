<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $starters = Category::create([
            'name' => 'Starters',
            'slug' => 'starters'
        ]);

        $main = Category::create([
            'name' => 'Main Course',
            'slug' => 'main'
        ]);

        $drinks = Category::create([
            'name' => 'Drinks',
            'slug' => 'drinks'
        ]);

        $desserts = Category::create([
            'name' => 'Desserts',
            'slug' => 'desserts'
        ]);


        // =========================
        // STARTERS
        // =========================

        MenuItem::create([
            'category_id' => $starters->id,
            'name' => 'Chicken Wings 🍗',
            'description' => 'Crispy chicken wings tossed in your choice of BBQ or spicy sauce.',
            'price' => 1.80,
            'image' => 'https://i.pinimg.com/1200x/ec/8a/ee/ec8aee3d078af75d59d2065bb774903b.jpg'
        ]);

        MenuItem::create([
            'category_id' => $starters->id,
            'name' => 'Garlic Bread 🥖',
            'description' => 'Freshly baked bread with garlic butter and herbs.',
            'price' => 1.26,
            'image' => 'https://i.pinimg.com/736x/15/a4/a7/15a4a7843c59808cad29506f1bbb8d75.jpg'
        ]);

        MenuItem::create([
            'category_id' => $starters->id,
            'name' => 'Chicken Soup 🍲',
            'description' => 'A warm and comforting bowl of chicken and mixed vegetable soup.',
            'price' => 1.37,
            'image' => 'https://i.pinimg.com/736x/32/1a/23/321a23414a2b867fc9b4c990c0d04bde.jpg'
        ]);


        // =========================
        // MAIN COURSE
        // =========================

        MenuItem::create([
            'category_id' => $main->id,
            'name' => 'Chicken Steak 🍗',
            'description' => 'Grilled chicken breast served with sautéed vegetables and fries.',
            'price' => 8.65,
            'image' => 'https://i.pinimg.com/736x/bc/cb/01/bccb0164a5d787e14a49a5358074e534.jpg'
        ]);

        MenuItem::create([
            'category_id' => $main->id,
            'name' => 'Chicken Alfredo Pasta 🍝',
            'description' => 'Creamy Alfredo pasta tossed with tender grilled chicken.',
            'price' => 6.49,
            'image' => 'https://i.pinimg.com/736x/30/45/e6/3045e669b2caf1cfd1a99d5781acaa91.jpg'
        ]);

        MenuItem::create([
            'category_id' => $main->id,
            'name' => 'Chicken Parmesan 🧀',
            'description' => 'Crispy chicken topped with tomato sauce and melted cheese, served with pasta.',
            'price' => 7.21,
            'image' => 'https://i.pinimg.com/736x/39/a9/bc/39a9bc1a49d5510021cb0ecccb91dfc1.jpg'
        ]);


        // =========================
        // DRINKS
        // =========================

        MenuItem::create([
            'category_id' => $drinks->id,
            'name' => 'Mango Smoothie 🥭',
            'description' => 'Creamy mango smoothie made with fresh mangoes.',
            'price' => 2.88,
            'image' => 'https://i.pinimg.com/736x/dd/85/b8/dd85b84eed17015e94196538106bcd34.jpg'
        ]);

        MenuItem::create([
            'category_id' => $drinks->id,
            'name' => 'Chocolate Shake 🍫',
            'description' => 'Smooth chocolate shake with a rich cocoa flavor.',
            'price' => 4.33,
            'image' => 'https://i.pinimg.com/736x/3f/e7/7f/3fe77ff941a217b854c9a7ae11041a32.jpg'
        ]);

        MenuItem::create([
            'category_id' => $drinks->id,
            'name' => 'Iced Tea 🧊',
            'description' => 'Refreshing iced tea with a sweet peach flavor.',
            'price' => 3.61,
            'image' => 'https://i.pinimg.com/736x/14/1b/6e/141b6ea8b2709eb919a02959e5441b15.jpg'
        ]);


        // =========================
        // DESSERTS
        // =========================

        MenuItem::create([
            'category_id' => $desserts->id,
            'name' => 'Vanilla Ice Cream 🍨',
            'description' => 'Creamy vanilla ice cream served with chocolate drizzle.',
            'price' => 2.70,
            'image' => 'https://i.pinimg.com/1200x/a8/95/59/a89559f6a492ffe320c052f9e6f4c5b7.jpg'
        ]);

        MenuItem::create([
            'category_id' => $desserts->id,
            'name' => 'Creme Brulee 🍮',
            'description' => 'Silky vanilla custard topped with a crisp caramelized crust.',
            'price' => 4.69,
            'image' => 'https://i.pinimg.com/736x/13/ff/47/13ff4778d9a7d263682b8a0733ddfc82.jpg'
        ]);

        MenuItem::create([
            'category_id' => $desserts->id,
            'name' => 'Pancakes 🥞',
            'description' => 'Fluffy pancakes served with syrup and fresh berries.',
            'price' => 3.43,
            'image' => 'https://i.pinimg.com/736x/78/73/09/787309d125270bd679b177da6a166f82.jpg'
        ]);
    }
}
