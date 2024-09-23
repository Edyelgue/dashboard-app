<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('change_status_incident', function (Blueprint $table) {
            $table->string('submitter');
            $table->string('createdate');
            $table->string('worklogsubmitter');
            $table->string('modifieddate');
            $table->text('notes');
            $table->string('incidentsummary');
            $table->string('incidentmodifieddate');
            $table->string('incidentsubmitter');
            $table->string('incidentid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('change_status_incident');
    }
};
