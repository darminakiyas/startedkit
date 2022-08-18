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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('noinduk');
            $table->string('jeniskelamin');
            $table->string('tempatlahir');
            $table->date('tgllahir');
            $table->string('agama');
            $table->string('jenjang_pendidikan');
            $table->string('jurusan');
            $table->string('asal_pendidikan');
            $table->date('tgl_lulus');
            $table->string('alamat');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('provinsi');
            $table->string('telepon');
            $table->string('image')->nullable();
            $table->string('password');
            $table->string('status_aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gurus');
    }
};
