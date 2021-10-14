<?php

use GamingEngine\Core\Framework\Migrations\CoreMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends CoreMigration {
    public function up()
    {
        if (Schema::hasTable('configurations')) {
            return;
        }

        Schema::create('configurations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('category');
            $table->string('key');

            $table->string('type');

            $table->string('default_value')
                ->nullable();
            $table->string('value')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique([
                'type',
                'key',
            ]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('configurations');
    }
};
