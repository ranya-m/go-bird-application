<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdentityVerificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'identity_number' => 'required|string',
            'identity_document' => 'required|file',
        ];
    }
}
