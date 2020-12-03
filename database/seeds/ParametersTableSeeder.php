<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parameters')->delete();

        $file = database_path('seeds/nms_incell.xlsx');

        Excel::selectSheets('parameters')
            ->load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    DB::table('parameters')->insert($row);
                }

            });


        $updated_at = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('parameters')->update($updated_at);
    }
}
