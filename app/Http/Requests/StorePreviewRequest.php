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
            'tipo'         => 'required|in:propia,personalizada,catalogo',
            'materialId'   => 'required|uuid|exists:materials,id',
            'colorId'      => 'required|uuid|exists:colors,id',
            'indicaciones' => 'nullable|string|max:2000',
        ];

        if ($tipo === 'propia') {
            $rules['file_3d']             = 'required|file|max:51200|extensions:obj,stl,3mf';
            $rules['altura_capa']         = 'nullable|numeric|min:0.05|max:0.5';
            $rules['porcentaje_relleno']  = 'nullable|integer|min:0|max:100';
            $rules['patron_relleno']      = 'nullable|in:rejilla,giroide,cubico,panal_de_abeja,panal_de_abeja_3d';
        } elseif ($tipo === 'personalizada') {
            $rules['file_imagen']  = 'nullable|file|max:10240|mimes:jpg,jpeg,png,gif,webp';
            $rules['indicaciones'] = 'required|string|max:2000';
        } elseif ($tipo === 'catalogo') {
            $rules['piezaId'] = 'required|uuid|exists:pieza_catalogos,id';
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
            'file_3d.required'    => 'Debes subir un archivo 3D.',
            'file_3d.extensions'  => 'El archivo debe ser de tipo OBJ, STL o 3MF.',
            'file_3d.max'         => 'El archivo no puede superar los 50MB.',
            'file_imagen.mimes'   => 'La imagen debe ser de tipo JPG, PNG, GIF o WEBP.',
            'file_imagen.max'     => 'La imagen no puede superar los 10MB.',
            'altura_capa.min'         => 'La altura de capa mínima es 0.05mm.',
            'altura_capa.max'         => 'La altura de capa máxima es 0.5mm.',
            'porcentaje_relleno.min'  => 'El porcentaje de relleno no puede ser negativo.',
            'porcentaje_relleno.max'  => 'El porcentaje de relleno no puede superar el 100%.',
            'patron_relleno.in'       => 'El patrón de relleno seleccionado no es válido.',
            'piezaId.required'        => 'Debes seleccionar una pieza del catálogo.',
            'piezaId.exists'          => 'La pieza seleccionada no existe en el catálogo.',
        ];
    }
}
