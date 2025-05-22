<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaTable extends Migration
{
public function up()
{
Schema::create('beritas', function (Blueprint $table) {
$table->id('id_berita'); // BIGINT with auto-increment
$table->string('judul', 255);
$table->text('isi');
$table->timestamps(); // created_at, updated_at
});
}

public function down()
{
Schema::dropIfExists('beritas');
}
}
?>
