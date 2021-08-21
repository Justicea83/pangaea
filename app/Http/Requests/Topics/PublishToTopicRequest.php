<?php

namespace App\Http\Requests\Topics;

use App\Models\Topic;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class PublishToTopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $topic = Arr::last(explode('/',$this->url()));
            if (Topic::query()->where('name',strtolower($topic))->first() == null) {
                $validator->errors()->add('topic', "the topic '$topic' is not valid");
            }
        });
    }
}
