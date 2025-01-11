<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->nullable()->after('name');
            $table->string('phone_number')->nullable()->after('email_verified_at');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->nullable();
            $table->dropColumn('phone_number');
        });
    }
}
