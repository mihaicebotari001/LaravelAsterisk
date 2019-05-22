<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelephonyHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telephony_history', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned()->default(0)->index('telephony_history_user_id_foreign');
            $table->enum('status', ['ANSWER', 'BUSY', 'NO ANSWER', 'CANCEL', 'CONGESTION', 'CHANUNAVAIL', 'DONTCALL', 'TORTURE', 'INVALIDARGS'])->default('ANSWER');
			$table->string('called_phone')->nullable();
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
		Schema::drop('telephony_history');
	}

}
