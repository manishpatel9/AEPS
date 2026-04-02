<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            $table->string('ticket_id', 40)->nullable()->unique()->after('id');
        });
    }

    public function down()
    {
        Schema::table('support_tickets', function (Blueprint $table) {
            $table->dropUnique(['ticket_id']);
            $table->dropColumn('ticket_id');
        });
    }
};
