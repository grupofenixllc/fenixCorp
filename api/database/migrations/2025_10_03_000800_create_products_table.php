<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('barcode')->nullable()->unique();
            $table->string('variant_ref')->nullable();
            $table->string('name');
            $table->foreignId('unit_id')->nullable()->constrained('units');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('provider_id')->nullable()->constrained('providers');
            $table->decimal('cost', 12, 2)->default(0);
            $table->decimal('price', 12, 2)->default(0);
            $table->json('attributes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};