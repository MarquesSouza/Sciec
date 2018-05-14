<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersActivitiesTable.
 */
class CreateUsersActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_activities', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('activities_id')->unsigned();
            $table->foreign('activities_id')->references('id')->on('activities')->onDelete('cascade');
            $table->boolean('presenca');
            $table->integer('user_activity_types_id')->unsigned();
            $table->foreign('user_activity_types_id')->references('id')->on('user_activity_types')->onDelete('cascade');

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
		Schema::drop('users_activities');
	}
}
