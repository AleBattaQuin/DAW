<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RutaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer este request
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Obtiene las reglas de validación para este request.
     *
     * @return array
     */
    public function rules(Request $request)
    {

        //Título requerido, máximo 32 caracteres
        //Slug máximo 36 caracteres (no requerido porque se generaría solo)
        //Entradilla máximo 128 caracteres (no requerida)
        $rules = [
            'nombre' => 'required|max:200',
            'slug' => 'max:200',
            'descripcion' => 'max:1000',
        ];

        return $rules;

    }
}
