<?php
namespace Tests\Feature\Sample;

use Illuminate\Database\Seeder;

class ListTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('samples')
            ->insert([
                [
                    'id'         => 'abc',
                    'title'      => 'first',
                    'is_done'    => false,
                    'created_at' => '2017-07-10',
                ],
                [
                    'id'         => 'def',
                    'title'      => 'second',
                    'is_done'    => false,
                    'created_at' => '2017-07-12',
                ],
                [
                    'id'         => 'ghi',
                    'title'      => 'third',
                    'is_done'    => true,
                    'created_at' => '2017-07-11',
                ]
            ]);
    }
}
