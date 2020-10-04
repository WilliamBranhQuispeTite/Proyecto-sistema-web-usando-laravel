<?php

namespace App\Http\Requests;

use App\Administrador;
use App\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsuarioRequest extends FormRequest
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
            'rol' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => 'required',
            'empresa' => 'required'
        ];
        
    }

    public function messages()
    {
        return [
            'numero.max' => 'El Numero deCelualt solo pude tener 9 dijitos',
            'dni.max' => 'El DNI solo pude tenr 8 dijitos',
            'email.required' => 'El correo es rquerido',
            'password.required' => 'Tiene que ingresar una contraseña',
        ];
    }
    public function crearUsu()
    {
        DB::transaction(function () {

            $data = $this->validated();

            $usu = Usuario::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'rol_id' => $data['rol'],
            ]);

            Administrador::create([
                'adm_nombre' => $data['nombre'],
                'adm_dni' => $data['dni'],
                'adm_celular' => $data['numero'],
                'emp_id' => $data['empresa'],
                'usu_id' => $usu->id
            ]);

            DB::commit();
        });

    }
    public function editarUsu()
    {

    }
}
