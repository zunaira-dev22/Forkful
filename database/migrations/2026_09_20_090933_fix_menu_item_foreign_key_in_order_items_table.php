<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Find existing foreign key
        |--------------------------------------------------------------------------
        |
        | order_items table pe foreign key kisi different name se ho sakti hai,
        | ya bilkul na bhi ho. Isliye fixed name se drop nahi karenge.
        |
        */

        $foreignKey = DB::selectOne("
            SELECT CONSTRAINT_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = 'order_items'
              AND COLUMN_NAME = 'menu_item_id'
              AND REFERENCED_TABLE_NAME IS NOT NULL
            LIMIT 1
        ");

        if ($foreignKey) {
            $constraintName = str_replace(
                '`',
                '``',
                $foreignKey->CONSTRAINT_NAME
            );

            DB::statement(
                "ALTER TABLE `order_items`
                 DROP FOREIGN KEY `{$constraintName}`"
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Make menu_item_id nullable
        |--------------------------------------------------------------------------
        */

        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_item_id')
                ->nullable()
                ->change();
        });


        /*
        |--------------------------------------------------------------------------
        | Fix old orphan order items
        |--------------------------------------------------------------------------
        |
        | Agar kisi old order item ka menu item pehle delete ho chuka hai,
        | uski ID ko NULL kar denge. Order history delete nahi hogi.
        |
        */

        DB::statement("
            UPDATE order_items AS oi
            LEFT JOIN menu_items AS mi
                ON mi.id = oi.menu_item_id
            SET oi.menu_item_id = NULL
            WHERE oi.menu_item_id IS NOT NULL
              AND mi.id IS NULL
        ");


        /*
        |--------------------------------------------------------------------------
        | Add correct foreign key
        |--------------------------------------------------------------------------
        |
        | Menu item delete hone par order item delete nahi hoga.
        | Sirf menu_item_id NULL ho jayega.
        |
        */

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('menu_item_id')
                ->references('id')
                ->on('menu_items')
                ->nullOnDelete();
        });
    }


    public function down(): void
    {
        $foreignKey = DB::selectOne("
            SELECT CONSTRAINT_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = 'order_items'
              AND COLUMN_NAME = 'menu_item_id'
              AND REFERENCED_TABLE_NAME IS NOT NULL
            LIMIT 1
        ");

        if ($foreignKey) {
            $constraintName = str_replace(
                '`',
                '``',
                $foreignKey->CONSTRAINT_NAME
            );

            DB::statement(
                "ALTER TABLE `order_items`
                 DROP FOREIGN KEY `{$constraintName}`"
            );
        }

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('menu_item_id')
                ->references('id')
                ->on('menu_items')
                ->cascadeOnDelete();
        });
    }
};