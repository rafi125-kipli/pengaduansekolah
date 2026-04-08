<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            if (! Schema::hasColumn('aspirasis', 'id_pelaporan')) {
                $table->unsignedInteger('id_pelaporan')->after('id_aspirasi');
                $table->foreign('id_pelaporan')->references('id_pelaporan')->on('input_aspirasis')->cascadeOnDelete();
            }
        });
    }

    public function down()
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            if (Schema::hasColumn('aspirasis', 'id_pelaporan')) {
                $table->dropForeign(['id_pelaporan']);
                $table->dropColumn('id_pelaporan');
            }
        });
    }
};
