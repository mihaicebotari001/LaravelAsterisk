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
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
			$table->string('host')->nullable();
			$table->string('username')->nullable();
			$table->string('secret')->nullable();
			$table->string('sip_number')->nullable();
			$table->string('account_code')->nullable();
            $table->enum('connection_type', ['SIP', 'IAX'])->default('SIP');
			$table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('telephony_credentials');
	}

}
