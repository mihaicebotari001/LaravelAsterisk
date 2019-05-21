<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelephonyCredentialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telephony_credentials', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned()->default(0)->index('telephony_credentials_user_id_foreign');
			$table->string('host')->nullable();
			$table->string('username')->nullable();
			$table->string('secret')->nullable();
			$table->string('sip_number')->nullable();
			$table->string('account_code')->nullable();
            $table->enum('connection_type', ['SIP', 'IAX'])->default('SIP');
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
		Schema::drop('telephony_credentials');
	}

}
