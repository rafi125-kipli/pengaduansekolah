<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('aspirasis')) {
            DB::statement('ALTER TABLE `aspirasis` MODIFY `feedback` TEXT NULL');
        }
    }

    public function down()
    {
        if (Schema::hasTable('aspirasis')) {
            DB::statement('ALTER TABLE `aspirasis` MODIFY `feedback` INT UNSIGNED NULL');
        }
    }
};
