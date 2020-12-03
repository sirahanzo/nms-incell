<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->delete();

        $file = database_path('seeds/nms_incell.xlsx');

        Excel::selectSheets('devices')
            ->load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    DB::table('devices')->insert($row);
                }

            });

        $updated_at = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('devices')->update($updated_at);
    }
}
