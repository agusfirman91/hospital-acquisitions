<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->default(null)->after('id');
        });
        Schema::table('comodities', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->default(null)->after('id');
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->default(null)->after('id');
        });
        Schema::table('material_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->default(null)->after('id');
        });
        Schema::table('warehouse', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->default(null)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['company_id']);
        });
        Schema::table('comodities', function (Blueprint $table) {
            $table->dropColumn(['company_id']);
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn(['company_id']);
        });
        Schema::table('material_groups', function (Blueprint $table) {
            $table->dropColumn(['company_id']);
        });
        Schema::table('warehouse', function (Blueprint $table) {
            $table->dropColumn(['company_id']);
        });
    }
}
