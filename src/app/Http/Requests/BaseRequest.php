<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Resources\Common\BadRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * ヴァリデーション失敗時の処理
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors()->toArray();
        $badRequest = new BadRequest(info: $errors);

        throw new HttpResponseException($badRequest->response());
    }
}
