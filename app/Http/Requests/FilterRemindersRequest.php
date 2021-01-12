<?php

namespace App\Http\Requests;

use App\Http\Enums\ReminderTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterRemindersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $enum = new ReminderTypeEnum();
        $possibleActions = $enum->getEnumList();

        return [
            'starts_at' => 'date_format:Y-m-d',
            'is_solved' => 'required',
            'type'          => [
                Rule::in($possibleActions),
            ],
        ];
    }
}
