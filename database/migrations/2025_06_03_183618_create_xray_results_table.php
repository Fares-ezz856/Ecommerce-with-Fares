<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXrayResultsTable extends Migration
{
    public function up()
    {
        Schema::create('xray_results', function (Blueprint $table) {
            $table->id();
            $table->json('result');  // نخزن نتيجة التحليل كاملة بصيغة JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('xray_results');
    }
}

