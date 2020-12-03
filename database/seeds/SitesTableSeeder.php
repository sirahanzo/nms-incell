<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->delete();

        $file = database_path('seeds/nms_incell.xlsx');

        Excel::selectSheets('sites')
            ->load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    DB::table('sites')->insert($row);
                }

            });

        $updated_at = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('sites')->update($updated_at);
    }
}
