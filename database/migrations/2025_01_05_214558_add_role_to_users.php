<?php

use App\Enums\UserRoles;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            /** Role Order
             * 1. Admin
             * 2. Editor
             * 3. Member
             */
            $table->tinyInteger("role")->default(UserRoles::MEMBER);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("role");
        });
    }
};
