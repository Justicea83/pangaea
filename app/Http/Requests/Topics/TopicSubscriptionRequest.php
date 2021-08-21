<?php

namespace App\Http\Requests\Topics;

use App\Models\Topic;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;

class TopicSubscriptionRequest extends FormRequest
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
            'url' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
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
            if ($this->has('url')) {
                if (filter_var($this->get('url'), FILTER_VALIDATE_URL) === false) {
                    $validator->errors()->add('url', "the url is not valid");
                }
            }

            $topic = Arr::last(explode('/',$this->url()));
            if (Topic::query()->where('name',strtolower($topic))->first() == null) {
                $validator->errors()->add('topic', "the topic '$topic' is not valid");
            }
        });
    }
}
