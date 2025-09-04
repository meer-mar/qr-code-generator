<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebSettingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('web_settings', function (Blueprint $table) {
        $table->id();
        $table->string('site_title');
        $table->text('meta_description');
        $table->text('site_logo');
        $table->string('logo');
        $table->string('site_email')->nullable();
        $table->string('site_phone')->nullable();
        $table->string('site_footer_logo')->nullable();
        $table->string('site_fb')->nullable();
        $table->string('site_instagram')->nullable();
        $table->string('site_twitter')->nullable();
        $table->string('site_linkedn')->nullable();
        $table->string('site_address')->nullable();
        $table->string('site_url');
        $table->string('site_fav');
        $table->string('site_author');
        $table->text('theme_footer');
        $table->tinyInteger('status');
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
    Schema::dropIfExists('web_settings');
  }
}
