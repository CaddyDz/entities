<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entities', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('parent_id')->nullable();
			$table->foreign('parent_id')->references('id')->on('entities')->onDelete('cascade');
			$table->string('name');
			$table->unsignedBigInteger('barcode')->unique();
			$table->text('description');
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
		Schema::dropIfExists('entities');
	}
}
