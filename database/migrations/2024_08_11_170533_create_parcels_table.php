<?php
/**
 * Creates the parcels table to store parcel details including dimensions, weight, and associated courier.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipient_id')->constrained()->onDelete('cascade');
            $table->float('width');
            $table->float('height');
            $table->float('length');
            $table->float('weight');
            $table->string('courier');
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
        Schema::dropIfExists('parcels');
    }
}
