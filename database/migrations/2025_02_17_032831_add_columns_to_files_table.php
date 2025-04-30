<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToFilesTable extends Migration
{
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->string('title_communication')->nullable();
            $table->string('office')->nullable();
            $table->string('remarks')->nullable();
            $table->date('date_received')->nullable();
        });
    }

    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn(['title_communication', 'office', 'remarks', 'date_received']);
        });
    }
}
