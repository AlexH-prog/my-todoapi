<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\PriorityStatusEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return false;
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->request->get('status') == 'done') {
            $currentDataTime = date('Y-m-d H:i:s');
            $this->merge([
                'completed_at' => $currentDataTime
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'max:255'],
            'description' => 'string',
            'status' =>  [Rule::enum(TaskStatusEnum::class)],
            'priority' =>  [Rule::enum(PriorityStatusEnum::class)],
            'parent_id' => 'exists:tasks,id',
            'user_id' => 'exists:users,id',
            'completed_at' =>  'date_format:Y-m-d H:i:s',
        ];
    }
}
