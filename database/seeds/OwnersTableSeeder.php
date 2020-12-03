<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OwnersTableSeeder extends Seeder {


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->delete();

        $file = database_path('seeds/nms_incell.xlsx');

        Excel::selectSheets('owners')
            ->load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    DB::table('owners')->insert($row);
                }

            });

        $updated_at = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('owners')->update($updated_at);
    }
}
