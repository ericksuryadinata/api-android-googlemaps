<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTglMasukTanggalBayarDpp2Image extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students',function (Blueprint $table) {
            $table->date('tgl_masuk')->after('nationality')->nullable();
            $table->date('tgl_keluar')->after('tgl_masuk')->nullable();
            $table->integer('dpp')->after('tgl_keluar')->nullable();
            $table->string('photo1')->after('photo')->nullable();
            $table->string('photo2')->after('photo1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('tgl_masuk');
        $table->dropColumn('tgl_keluar');
        $table->dropColumn('dpp');
        $table->dropColumn('photo1');
        $table->dropColumn('photo2');
    }
}
