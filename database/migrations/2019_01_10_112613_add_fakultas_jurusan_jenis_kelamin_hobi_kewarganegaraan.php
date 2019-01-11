<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFakultasJurusanJenisKelaminHobiKewarganegaraan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students',function (Blueprint $table) {
            $table->string('faculty')->after('address')->nullable();
            $table->string('major')->after('faculty')->nullable();
            $table->string('gender')->after('major')->nullable();
            $table->string('hoby')->after('gender')->nullable();
            $table->string('nationality')->after('hoby')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('faculty');
        $table->dropColumn('major');
        $table->dropColumn('gender');
        $table->dropColumn('hoby');
        $table->dropColumn('nationality');
        
    }
}
