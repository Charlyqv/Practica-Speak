<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique(table: 'lessons', column: 'name')->ignore(id: request('lesson'), idColumn: 'id')],
            'description' => ['required', 'string', 'max:500'],
            'content_uri' => ['required', 'string', 'max:255'],
            'pdf_uri' => ['required', 'string', 'max:255'],
            'level_id' => ['required', 'integer', 'max:11'],
        ];
    }

    public function messages():array
    {
        return [
            'name.unique' => __('The category already exists.')
        ];
    }
}
