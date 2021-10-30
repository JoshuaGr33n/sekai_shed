// app/database/seeds/DatabaseSeeder.php

<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
     // Eloquent::unguard();

      $this->call('UserTableSeeder');
  }

}
?>
