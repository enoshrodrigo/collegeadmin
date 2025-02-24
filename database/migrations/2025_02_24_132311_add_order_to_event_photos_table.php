<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderToEventPhotosTable extends Migration
{
    public function up()
    {
        Schema::table('event_photos', function (Blueprint $table) {
            // Add an integer 'order' column with a default value.
            $table->integer('order')->default(0);
        });

        // Optional: Update existing records with sequential order based on creation order.
        // You can use raw SQL or an Eloquent loop.
        // Note: For large datasets, consider using a raw query.
        $photos = \App\Models\EventPhoto::orderBy('id')->get();
        $order = 1;
        foreach ($photos as $photo) {
            $photo->order = $order++;
            $photo->save();
        }
    }

    public function down()
    {
        Schema::table('event_photos', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
