<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SeviritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('severities')->delete();

        $file = database_path('seeds/nms_incell.xlsx');

        Excel::selectSheets('severities')
            ->load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    DB::table('severities')->insert($row);
                }

            });

        $updated_at = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('severities')->update($updated_at);
    }
}
