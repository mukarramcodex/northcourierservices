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
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->unique();
            $table->string('receipt_number')->nullable();
            $table->string('qr_code')->nullable();

            $table->string('sender_name');
            $table->string('sender_cnic', 15)->nullable();
            $table->string('sender_phone', 11)->unique();
            $table->string('sender_email')->unique();


            $table->string('receiver_name');
            $table->string('receiver_cnic', 15)->nullable();
            $table->string('receiver_email')->unique();
            $table->string('receiver_phone', 11)->unique();

            $table->string('origin');
            $table->string('destination');
            $table->string('booking_point')->nullable();
            $table->string('delivery_point')->nullable();

            $table->decimal('weight')->nullable();
            $table->string('dimension')->nullable();
            $table->string('packing_type')->nullable();
            $table->decimal('pieces', 5, 2)->default(1);
            $table->string('goods_description')->nullable();
            $table->text('remarks')->nullable();

            $table->decimal('fare', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();

            $table->date('booking_time')->nullable();
            $table->unsignedBigInteger('booking_officer');
            $table->foreign('booking_officer')->references('id')->on('users')->onDelete('cascade');
            $table->string('branch')->nullable();
            $table->enum('status', ['Pending', 'In Transit', 'Out for Delivery', 'Delivered'])
                        ->default('Pending');
            $table->enum('payment_status', ['Un Paid', 'Paid'])
                        ->default('Un Paid');
            $table->string('tracking_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcels');
    }
};
