<?php

use App\Frequency;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFrequencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Frequency::create([
            'name' => 'Every Day',
            'days' => '1',
        ]);

        Frequency::create([
            'name' => 'Every Other Day',
            'days' => '2',
        ]);

        Frequency::create([
            'name' => 'Twice/week',
            'days' => '3',
        ]);

        Frequency::create([
            'name' => 'Weekly',
            'days' => '7',
        ]);

        Frequency::create([
            'name' => 'Biweekly',
            'days' => '14',
        ]);

        Frequency::create([
            'name' => 'Monthly',
            'days' => '30',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Frequency::where('id', '>', 0)->delete();
    }
}
