<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateTaskRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string|max:255',
            'desc' => 'nullable|string|max:65000',
            'list_id' => [
                Rule::exists('lists', 'id')->whereIn(
                    'board_id', $this->getAuthUserBoardIds()
                )
            ],
            'assigned_to' => 'nullable|exists:users,id',
        ];
    }

    protected function getAuthUserBoardIds()
    {
        return Auth::user()->boards()->get(['boards.id'])->pluck('id')->toArray();
    }
}
