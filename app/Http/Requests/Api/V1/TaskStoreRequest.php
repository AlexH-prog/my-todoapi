<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\PriorityStatusEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       // return false;
       return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */

    protected function prepareForValidation(): void
    {
        if(Auth::id()) {
        $this->merge([
            'user_id' => Auth::id(),
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
                'title' => ['required', 'string', 'max:255'],
                'description' => 'string',
                'status' => 'required', [Rule::enum(TaskStatusEnum::class)],
                'priority' => 'required', [Rule::enum(PriorityStatusEnum::class)],
                'parent_id' => ['required', 'nullable' ],
                'user_id' => ['required'],
             ];
    }

}
