<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('color_settings', function (Blueprint $table) {
            $table->id();
            $table->string('body_color', 7)->default('#ffffff');
            $table->string('header_color', 7)->default('#ff3130');
            $table->string('footer_color', 7)->default('#333333');
            $table->string('headings_color', 7)->default('#000000');
            $table->string('label_color', 7)->default('#000000');
            $table->string('paragraph_color', 7)->default('#000000');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('color_settings');
    }
}
