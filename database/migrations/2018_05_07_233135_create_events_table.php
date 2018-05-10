<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEventsTable.
 */
class CreateEventsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->longText('descricao');
            $table->longText('local');
            $table->dateTime('data_inicio');
            $table->dateTime('data_conclusao');
            $table->boolean('situacao');
            $table->boolean('status');
            $table->integer('institutions_id')->unsigned();
            $table->foreign('institutions_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->string('coordenador');

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
		Schema::drop('events');
	}
}
