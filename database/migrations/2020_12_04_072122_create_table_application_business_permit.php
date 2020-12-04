<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableApplicationBusinessPermit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_business_permit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('owner_user_id')->nullable();
            $table->string('business_id')->nullable();
            $table->string('type')->nullable();
            $table->string('owner_firstname')->nullable();
            $table->string('owner_middlename')->nullable();
            $table->string('owner_lastname')->nullable();
            $table->string('owner_suffix')->nullable();
            $table->string('owner_tin')->nullable();
            $table->string('owner_mobile_no')->nullable();
            $table->string('owner_unit_no')->nullable();
            $table->string('owner_street_address')->nullable();
            $table->string('owner_brgy')->nullable();
            $table->string('owner_brgy_name')->nullable();
            $table->string('owner_zipcode')->nullable();
            $table->string('owner_town')->nullable();
            $table->string('owner_town_name')->nullable();
            $table->string('owner_province')->nullable();
            $table->string('owner_province_name')->nullable();
            $table->string('owner_region')->nullable();
            $table->string('owner_region_name')->nullable();
            $table->string('business_amendment')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_dominant_name')->nullable();
            $table->string('business_bn_number')->nullable();
            $table->string('business_scope')->nullable();
            $table->string('business_type')->nullable();
            $table->string('business_mobile_no')->nullable();
            $table->string('business_telephone_no')->nullable();
            $table->string('business_email')->nullable();
            $table->string('business_unit_no')->nullable();
            $table->string('business_street_address')->nullable();
            $table->string('business_brgy')->nullable();
            $table->string('business_brgy_name')->nullable();
            $table->string('business_zipcode')->nullable();
            $table->string('business_town')->nullable();
            $table->string('business_town_name')->nullable();
            $table->string('business_province')->nullable();
            $table->string('business_province_name')->nullable();
            $table->string('business_region')->nullable();
            $table->string('business_region_name')->nullable();
            $table->string('business_tin_no')->nullable();
            $table->string('business_sss_no')->nullable();
            $table->string('business_philhealth_no')->nullable();
            $table->string('business_pagibig_no')->nullable();
            $table->string('ctc_no')->nullable();
            $table->string('tax_incentive')->nullable();
            $table->string('ctc_date_issue')->nullable();
            $table->string('business_area')->nullable();
            $table->string('is_owned')->nullable();
            $table->string('lessor_fullname')->nullable();
            $table->string('lessor_full_address')->nullable();
            $table->string('lessor_phone_no')->nullable();
            $table->string('lessor_email')->nullable();
            $table->string('monthly_rental')->nullable();
            $table->string('emergency_contact_fullname')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_email')->nullable();
            $table->string('application_date')->nullable();

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
        Schema::dropIfExists('application_business_permit');
    }
}
