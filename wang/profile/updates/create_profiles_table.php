<?php namespace Wang\Profile\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('wang_profile_profiles', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('headline')->nullable();
            $table->text('about_me')->nullable();
            $table->text('interets')->nullable();
            $table->text('books')->nullable();
            $table->text('music')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wang_profile_profiles');
    }
}
