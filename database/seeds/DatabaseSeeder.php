<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OwnersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ManufacturersTableSeeder::class);
        $this->call(SeviritiesTableSeeder::class);
        $this->call(DeviceTypesTableSeeder::class);
        $this->call(DevicesTableSeeder::class);
        //$this->call(RegionsTableSeeder::class);
        //$this->call(CitiesTableSeeder::class);
        //$this->call(SitesTableSeeder::class);
        $this->call(ParametersTableSeeder::class);
        //$this->call(DeviceNodeTableSeeder::class);
        //$this->call(PollingDataTableSeeder::class);
        //$this->call(PollingAlarmTableSeeder::class);

    }
}
