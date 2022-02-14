<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->float('price');
            $table->string('raw_material', 50);
            $table->date('production_time');
            $table->timestamps();

        });

        DB::table('products')->insert(array('id'=>'1','name'=>'Csirkemell sonka','price'=>'6700.13','raw_material'=>'csirke','production_time'=>'2022-02-13','created_at'=>'2022-02-13 14:15:00','updated_at'=>'2022-02-13 15:15:00'));
        DB::table('products')->insert(array('id'=>'2','name'=>'Ló kolbász','price'=>'5855.58','raw_material'=>'ló','production_time'=>'2022-01-22','created_at'=>'2022-02-13 14:15:00','updated_at'=>'2022-02-13 15:15:00'));
        DB::table('products')->insert(array('id'=>'3','name'=>'Sertés sonka','price'=>'9784','raw_material'=>'sertés','production_time'=>'2021-12-30','created_at'=>'2022-02-13 14:15:00','updated_at'=>'2022-02-13 15:15:00'));
        DB::table('products')->insert(array('id'=>'4','name'=>'Marha felvágott','price'=>'100','raw_material'=>'marha','production_time'=>'2022-02-09','created_at'=>'2022-02-13 14:15:00','updated_at'=>'2022-02-13 15:15:00'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
