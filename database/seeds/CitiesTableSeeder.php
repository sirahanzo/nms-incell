<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();

        $file = database_path('seeds/nms_incell.xlsx');

        Excel::selectSheets('cities')
            ->load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    DB::table('cities')->insert($row);
                }

            });

        $updated_at = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('cities')->update($updated_at);
    }
}
