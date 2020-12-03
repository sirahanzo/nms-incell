<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DeviceNodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('device_nodes')->delete();

        $file = database_path('seeds/nms_incell.xlsx');

        Excel::selectSheets('device_nodes')
            ->load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    DB::table('device_nodes')->insert($row);
                }

            });

        $updated_at = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('device_nodes')->update($updated_at);
    }
}
