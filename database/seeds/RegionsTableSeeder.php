<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->delete();

        $file = database_path('seeds/nms_incell.xlsx');

        Excel::selectSheets('regions')
            ->load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    DB::table('regions')->insert($row);
                }

            });

        $updated_at = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('regions')->update($updated_at);
    }
}
