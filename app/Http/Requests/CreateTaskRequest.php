<?php

namespace App\Http\Requests;

class CreateTaskRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string|max:65000',
            'list_id' => 'required|exists:lists,id',
            'assigned_to' => 'required|exists:users,id',
        ];
    }
}