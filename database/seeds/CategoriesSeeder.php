<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment(['local', 'development', 'staging'])) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('categories')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            DB::table('categories')->insert([
                'name' => "Standard",
                'created_at' => \Carbon\Carbon::now()
            ]);

            DB::table('categories')->insert([
                'name' => "Premium",
                'created_at' => \Carbon\Carbon::now()
            ]);

            DB::table('categories')->insert([
                'name' => "Deluxe",
                'created_at' => \Carbon\Carbon::now()
            ]);

            DB::table('categories')->insert([
                'name' => "ParentCategory",
                'created_at' => \Carbon\Carbon::now()
            ]);

            DB::table('category_relations')->insert([
                'child_category_id' => DB::table('categories')->where('name', '=', 'Standard')->first('id')->id,
                'parent_category_id' => DB::table('categories')->where('name', '=', 'ParentCategory')->first('id')->id,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
