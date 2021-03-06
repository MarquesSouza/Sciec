<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateActivitiesTable.
 */
class CreateActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->longText('descricao');
            $table->longText('local');
            $table->dateTime('data_inicio');
            $table->dateTime('data_conclusao');
            $table->time('horas');
            $table->integer('qtd_inscritos');
            $table->boolean('status');
            $table->integer('type_activity_id')->unsigned();
            $table->foreign('type_activity_id')->references('id')->on('type_activities')->onDelete('cascade');
            $table->integer('events_id')->unsigned();
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');

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
		Schema::drop('activities');
	}
}
