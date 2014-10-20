<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('inventories', function(Blueprint $table)
            {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->integer('category_id')->unsigned()->nullable();
                $table->integer('user_id')->unsigned()->nullable();
                $table->string('name');
                $table->text('description')->nullable();
                
                $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('restrict')
                    ->onDelete('set null');
                
                $table->foreign('category_id')->references('id')->on('categories')
                    ->onUpdate('restrict')
                    ->onDelete('set null');
            });
            
            Schema::create('inventory_stocks', function(Blueprint $table)
            {
                $table->increments('id');
                $table->timestamps();
                $table->integer('inventory_id')->unsigned();
                $table->integer('location_id')->unsigned();
                $table->decimal('quantity', 8, 2)->default(0);
                
                $table->foreign('inventory_id')->references('id')->on('inventories')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
                
                $table->foreign('location_id')->references('id')->on('locations')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
            });
            
            Schema::create('inventory_stock_movements', function(Blueprint $table)
            {
                $table->increments('id');
                $table->timestamps();
                $table->integer('stock_id')->unsigned();
                $table->integer('user_id')->unsigned()->nullable();
                $table->decimal('before', 8, 2)->default(0);
                $table->decimal('after', 8, 2)->default(0);
                $table->decimal('cost', 8, 2)->default(0)->nullable();
                $table->string('reason')->nullable();
                
                $table->foreign('stock_id')->references('id')->on('inventory_stocks')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
                
                $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('restrict')
                    ->onDelete('set null');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('inventory_stock_movements');
            Schema::drop('inventory_stocks');
            Schema::drop('inventories');
	}

}
