<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $file = database_path('seeds/nms_incell.xlsx');

        Excel::selectSheets('roles')
            ->load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    DB::table('roles')->insert($row);
                }

            });

        $updated_at = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('roles')->update($updated_at);
    }
}
