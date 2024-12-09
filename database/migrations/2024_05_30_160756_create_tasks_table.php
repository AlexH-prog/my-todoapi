<?php

use App\Enums\PriorityStatusEnum;
use App\Enums\TaskStatusEnum;
use App\Models\User;
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
        Schema::create('tasks', function (Blueprint $table) {

            $table->id();
            $table->string('title')->fulltext();
            $table->text('description')->fulltext();

           $table->enum('status', [
               TaskStatusEnum::TODO->value,
               TaskStatusEnum::DONE->value
           ])->default(TaskStatusEnum::TODO->value);

           $table->enum('priority',[
               PriorityStatusEnum::ONE->value,
               PriorityStatusEnum::TWO->value,
               PriorityStatusEnum::THREE->value,
               PriorityStatusEnum::FOUR->value,
               PriorityStatusEnum::FIVE->value
           ])->default(PriorityStatusEnum::FIVE->value);

            $table->foreignId('user_id');
            $table->index('user_id', 'task_user_idx');
            $table->foreign('user_id', 'task_user_fk')->on('users')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
            $table->timestamp('completed_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
