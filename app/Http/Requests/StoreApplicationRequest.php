<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreApplicationRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            'subject' => 'required|max:191',
            'message' => 'required',
            'file'=> File::types(['jpg','png','pdf'])->max(12*1024),
        ];
    }
}
