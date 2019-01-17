<?php

namespace Tests\Unit\Adapters\Gateways\DataSources\Databases;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class QueryTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = QueryTest::$table;
        Schema::dropIfExists($table);
        Schema::create($table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('count');
        });

        \DB::table($table)
            ->insert([
                [
                    'id'    => 1,
                    'count' => 10,
                ],
                [
                    'id'    => 2,
                    'count' => 5,
                ],
                [
                    'id'    => 3,
                    'count' => 20,
                ]
            ]);
    }
}
