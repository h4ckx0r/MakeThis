<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePreviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tipo = $this->input('tipo');

        $rules = [
            'tipo'         => 'required|in:propia,personalizada',
            'materialId'   => 'required|uuid|exists:materials,id',
            'colorId'      => 'required|uuid|exists:colors,id',
            'indicaciones' => 'nullable|string|max:2000',
        ];

        if ($tipo === 'propia') {
            $rules['archivo_path']        = 'required|string';
            $rules['archivo_nombre']      = 'required|string';
            $rules['altura_capa']         = 'nullable|numeric|min:0.05|max:0.5';
            $rules['porcentaje_relleno']  = 'nullable|integer|min:0|max:100';
            $rules['patron_relleno']      = 'nullable|in:linear,grid,gyroid,honeycomb';
        } else {
            $rules['archivo_path']   = 'nullable|string';
            $rules['archivo_nombre'] = 'nullable|string';
            $rules['indicaciones']   = 'required|string|max:2000';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'tipo.required'           => 'Debes seleccionar un tipo de solicitud.',
            'tipo.in'                 => 'El tipo de solicitud no es válido.',
            'materialId.required'     => 'Debes seleccionar un material.',
            'materialId.exists'       => 'El material seleccionado no existe.',
            'colorId.required'        => 'Debes seleccionar un color.',
            'colorId.exists'          => 'El color seleccionado no existe.',
            'indicaciones.required'   => 'Las indicaciones son obligatorias para solicitudes personalizadas.',
            'indicaciones.max'        => 'Las indicaciones no pueden superar los 2000 caracteres.',
            'archivo_path.required'   => 'Debes subir un archivo 3D.',
            'archivo_nombre.required' => 'El nombre del archivo es obligatorio.',
            'altura_capa.min'         => 'La altura de capa mínima es 0.05mm.',
            'altura_capa.max'         => 'La altura de capa máxima es 0.5mm.',
            'porcentaje_relleno.min'  => 'El porcentaje de relleno no puede ser negativo.',
            'porcentaje_relleno.max'  => 'El porcentaje de relleno no puede superar el 100%.',
            'patron_relleno.in'       => 'El patrón de relleno seleccionado no es válido.',
        ];
    }
}
