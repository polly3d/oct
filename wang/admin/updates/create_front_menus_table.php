<?php namespace Wang\Admin\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFrontMenusTable extends Migration
{
    public function up()
    {
        Schema::create('wang_admin_front_menus', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('url');
            $table->integer('order');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wang_admin_front_menus');
    }
}
