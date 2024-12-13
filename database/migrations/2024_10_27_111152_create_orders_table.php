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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();  // Идентификатор заказа
            $table->date('date');  // Дата заказа
            $table->string('number')->unique();  // Номер заказа (уникальный)
            $table->string('customer_name');  // ФИО клиента
            $table->decimal('total_amount', 10, 2);  // Общая сумма заказа
            $table->timestamps();  // Поля created_at и updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
