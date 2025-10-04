<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('import_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('provider_id')->constrained('providers')->cascadeOnDelete();
            $table->json('mapping'); // JSON que indica columna del PDF/Excel para código, descripción, unidad, precio
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('import_mappings');
    }
};