<?php

use App\Helpers\LabelsAPI;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clan_labels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url_m');
            $table->string('url_s');
            $table->timestamps();
        });

        LabelsAPI::saveClanLabels();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('clan_labels');
    }
};
