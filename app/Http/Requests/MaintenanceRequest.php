<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'applicant' => 'nullable|string|max:255',
            'responsible' => 'nullable|string|max:255',
            'departement' => 'nullable|string|max:255',
            'door_number' => 'nullable|string|max:255',
            'hardware' => 'nullable|string|max:255',
            'hardware_other' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'os_type' => 'nullable|string|max:255',
            'licence' => 'nullable|string|max:255',
            'other' => 'nullable|string|max:255',
            'comment' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'intervention_type' => 'nullable|string|max:255',
            'other_intervention' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer',
            'connected' => 'boolean',
            'protocol' => 'nullable|string|max:255',
        ];
    }
}
