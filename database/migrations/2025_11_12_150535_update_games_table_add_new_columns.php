<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
              $table->time('start_time')->nullable()->before("result_timing");
            $table->time('end_time')->nullable()->before("result_timing");
            $table->boolean('status')->default(false)->after("result_timing");
            $table->enum('time_type', ['after', 'before'])->default('before')->after("result_timing");
            $table->date('date')->nullable()->after("result_timing");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            //
        });
    }
};
