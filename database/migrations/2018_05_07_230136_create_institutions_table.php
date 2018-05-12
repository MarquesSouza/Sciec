<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateInstitutionsTable.
 */
class CreateInstitutionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institutions', function(Blueprint $table) {
            $table->increments('id',100);
            $table->string('nome',45);
            $table->text('descricao');
            $table->string('site',100)->unique();
            $table->string('email',45)->unique();
            $table->string('telefone',45);
            $table->boolean('status');
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
		Schema::drop('institutions');
	}
}
