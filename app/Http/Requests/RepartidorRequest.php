<?php

namespace App\Http\Requests;

use App\Repartidor;
use App\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RepartidorRequest extends FormRequest
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
    public function rules()
    {
        return [

            'nombre' => 'required',
            'dni' => ['required', 'max:8'],
            'numero' => ['required', 'max:9'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => 'required',
            'empresa' => 'required'
        ];
        
    }
    public function messages()
    {
        return [
            'numero.max' => 'El Numero de celular solo pude tener 9 dijitos',
            'dni.max' => 'El DNI solo pude tenr 8 dijitos',
            'email.required' => 'El correo es rquerido',
            'password.required' => 'Tiene que ingresar una contraseña',
        ];
    }
    public function crearRep()
    {
        DB::transaction(function () {
            $data = $this->validated();
            $usu = Usuario::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'rol_id' => 3, // rol de repartidor 3
            ]);
            Repartidor::create([
                'rep_nombre' => $data['nombre'],
                'rep_dni' => $data['dni'],
                'rep_celular' => $data['numero'],
                'emp_id' => $data['empresa'],
                'usu_id' => $usu->id
            ]);

            DB::commit();
        });
    }
}
