<?php

use GamingEngine\Core\Framework\Migrations\CoreMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends CoreMigration {
    public function up()
    {
        if (Schema::hasTable('framework_modules')) {
            return;
        }

        Schema::create('framework_modules', function (Blueprint $table) {
            $table->id();

            $table->string('module_name', 50)
                ->unique();
            $table->string('license_key')
                ->nullable();
            $table->dateTime('enabled_at')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('framework_modules');
    }
};
