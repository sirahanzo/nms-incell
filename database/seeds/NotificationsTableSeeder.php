<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notification_type')->delete();

        $file = database_path('seeds/nms_incell.xlsx');

        Excel::selectSheets('notification_type')
            ->load($file, function ($reader) {

                foreach ($reader->toArray() as $row) {
                    DB::table('notification_type')->insert($row);
                }

            });

        $updated_at = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('notification_type')->update($updated_at);
    }
}
