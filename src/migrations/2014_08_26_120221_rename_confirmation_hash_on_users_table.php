<?php

use Illuminate\Database\Migrations\Migration;

class RenameConfirmationHashOnUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->renameColumn('confirmation_hash', 'activation_hash');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
			$table->renameColumn('activation_hash', 'confirmation_hash');
		});
	}

}
