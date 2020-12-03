<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufacturers')->delete();

        $file = database_path('seeds/nms_incell.xlsx');

        Excel::selectSheets('manufacturers')
            ->load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    DB::table('manufacturers')->insert($row);
                }

            });

        $updated_at = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('manufacturers')->update($updated_at);
    }
}
