<?php

use GamingEngine\Core\Framework\Migrations\CoreMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends CoreMigration
{
    public function up()
    {
        Schema::create('framework_migrations', function (Blueprint $table) {
            $table->id();

            $table->string('migration', 75);
            $table->string('package_name', 50);

            $table->timestamps();
            $table->softDeletes();

            $table->unique([
                'migration',
                'package_name',
                'deleted_at',
            ]);
        });
    }

    public function down()
    {
        Schema::drop('framework_migrations');
    }
};
