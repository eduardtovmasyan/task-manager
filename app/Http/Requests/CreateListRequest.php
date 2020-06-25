<?php

namespace App\Http\Requests;

class CreateListRequest extends Request
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
            'board_id' => 'required|exists:boards,id',
        ];
    }
}