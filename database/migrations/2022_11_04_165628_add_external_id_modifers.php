<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExternalIdModifers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modifiers', function (Blueprint $table) {
            //
            $table->string('external_id');
            $table->boolean('is_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modifiers', function (Blueprint $table) {
            //
            $table->dropColumn('external_id');
            $table->dropColumn('is_active');
        });
    }
}
