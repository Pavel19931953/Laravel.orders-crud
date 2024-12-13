<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();  // Идентификатор позиции заказа
            $table->foreignId('order_id')->constrained()->onDelete('cascade');  // Внешний ключ к таблице заказов
            $table->string('product_name');  // Название товара
            $table->decimal('price', 10, 2);  // Цена товара
            $table->integer('quantity');  // Количество
            $table->decimal('cost', 10, 2);  // Стоимость (цена * количество)
            $table->timestamps();  // Поля created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
