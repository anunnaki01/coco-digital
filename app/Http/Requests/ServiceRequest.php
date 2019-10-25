<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * Class ServiceRequest
 * @package App\Http\Requests
 */
class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'id' => $this->getIdRule(),
            'name' => ['required', 'string', 'max:255'],
            'preparation' => ['required', 'string', 'max:255'],
            'time' => ['required', 'string', 'max:255'],
            'place_id' => 'required|numeric',
            'is_enabled' => 'numeric',
        ];
    }

    /**
     * @return string
     */
    public function getIdRule(): string
    {
        if (Request::route()->getName() == 'service-update') {
            return 'required|numeric|min:1|exists:service,id';
        }

        return 'nullable';
    }
}
