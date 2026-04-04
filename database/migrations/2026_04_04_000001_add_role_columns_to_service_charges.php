<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleColumnsToServiceCharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_charges', function (Blueprint $table) {
            if (!Schema::hasColumn('service_charges', 'commission_type')) {
                $table->string('commission_type')->default('percent')->after('service_type');
            }
            if (!Schema::hasColumn('service_charges', 'business_partner')) {
                $table->decimal('business_partner', 10, 2)->default(0)->after('commission_type');
            }
            if (!Schema::hasColumn('service_charges', 'master_distributor')) {
                $table->decimal('master_distributor', 10, 2)->default(0)->after('business_partner');
            }
            if (!Schema::hasColumn('service_charges', 'distributor')) {
                $table->decimal('distributor', 10, 2)->default(0)->after('master_distributor');
            }
            if (!Schema::hasColumn('service_charges', 'agent')) {
                $table->decimal('agent', 10, 2)->default(0)->after('distributor');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_charges', function (Blueprint $table) {
            if (Schema::hasColumn('service_charges', 'agent')) {
                $table->dropColumn('agent');
            }
            if (Schema::hasColumn('service_charges', 'distributor')) {
                $table->dropColumn('distributor');
            }
            if (Schema::hasColumn('service_charges', 'master_distributor')) {
                $table->dropColumn('master_distributor');
            }
            if (Schema::hasColumn('service_charges', 'business_partner')) {
                $table->dropColumn('business_partner');
            }
            if (Schema::hasColumn('service_charges', 'commission_type')) {
                $table->dropColumn('commission_type');
            }
        });
    }
}
