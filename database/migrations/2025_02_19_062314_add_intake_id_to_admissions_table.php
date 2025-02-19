<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->unsignedBigInteger('intake_id')->nullable()->after('mobile_no');
            $table->foreign('intake_id')->references('id')->on('intakes')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropForeign(['intake_id']);
            $table->dropColumn('intake_id');
        });
    }
};
