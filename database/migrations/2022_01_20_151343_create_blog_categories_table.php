<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('blog_categories', function (Blueprint $table) {
      $table->id();
      $table->string('page_title')->nullable();
      $table->text('meta_desc')->nullable();
      $table->string('title');
      $table->string('slug');
      $table->string('image')->nullable();
      $table->text('description')->nullable();
      $table->tinyInteger('status');

      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('blog_categories');
  }
}
