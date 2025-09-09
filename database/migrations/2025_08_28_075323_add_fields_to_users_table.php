<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nrp')->unique()->after('id');
            $table->string('pangkat')->nullable();
            $table->string('korps')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('satuan')->nullable();
            $table->string('nik')->nullable();
            $table->string('alamat')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nrp','pangkat','korps','jabatan','satuan','nik','alamat']);
        });
    }
};
