<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabela 'tb_usuario' armazenara os dados do usuário no banco de dados, como secretarios da escola por exemplo;
        Schema::create('tb_usuario', function (Blueprint $table){
            $table->id('id_usuario');
            $table->string('nm_usuario', 100);
            $table->string('ds_email', 45);
            $table->string('cd_senha', 30);
            $table->string('nm_tipo', 20);
            $table->timestamps();
        });

        Schema::create('tb_curso', function (Blueprint $table){
            $table->id('id_curso');
            $table->string('nm_curso', 50);
        });

        Schema::create('tb_classe', function(Blueprint $table){
            $table->id('id_classe');
            $table->string('nm_classe', 45);
            $table->foreignId('id_curso')->references('id_curso')->on('tb_curso')->onDelete('cascade');
        });

        Schema::create('tb_aluno', function(Blueprint $table){
            $table->char('nm_rm', 5)->primary(true);
            $table->string('nm_aluno', 100);
            $table->char('cd_rfid', 8);
            $table->string('cd_senha', 30);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE tb_aluno ADD img_aluno LONGBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_usuario');
        Schema::dropIfExists('tb_curso');
        Schema::dropIfExists('tb_classe');
        Schema::dropIfExists('tb_aluno');

        DB::statement("ALTER TABLE tb_aluno DROP img_aluno LONGBLOB");
    }
};
