<?php

use GamingEngine\Core\Framework\Migrations\CoreMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends CoreMigration {
    public function up()
    {
        if (Schema::hasTable('framework_migrations')) {
            return;
        }

        Schema::create('framework_migrations', function (Blueprint $table) {
            $table->id();

            $table->string('migration', 75);
            $table->string('module_name', 50);

            $table->timestamps();
            $table->softDeletes();

            $table->unique([
                'migration',
                'module_name',
                'deleted_at',
            ]);
        });
    }

    public function down()
    {
        Schema::drop('framework_migrations');
    }
};
