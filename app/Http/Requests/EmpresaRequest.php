<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\{Empresa,Usuario,Administrador};
class EmpresaRequest extends FormRequest
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
            'emp_razonSocial' => 'required',
            'emp_correo' => ['required','email'],
            'emp_ruc' => ['required', 'max:11'],
            'emp_numero' => ['required', 'max:9'],

            'adm_nombre' => 'required',
            'adm_dni' => ['required', 'max:8'],
            'adm_numero' => ['required', 'max:9'],

            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'emp_razonSocial.required' => 'Razon social es requerido',
            'email.required' => 'El correo es rquerido',
            'password.required' => 'Tiene que ingresar una contraseña',
        ];
    }
    public function crearEmp()
    {
        DB::transaction(function () {

            $data = $this->validated();

            $emp = Empresa::create([
                'emp_nombre' => $data['emp_razonSocial'],
                'emp_correo' => $data['emp_correo'],
                'emp_ruc' => $data['emp_ruc'],
                'emp_celular' => $data['emp_numero'],
            ]);

            $usu = Usuario::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'rol_id' => '1',
            ]);

            Administrador::create([
                'adm_nombre' => $data['adm_nombre'],
                'adm_dni' => $data['adm_dni'],
                'adm_celular' => $data['adm_numero'],
                'emp_id' => $emp->id,
                'usu_id' => $usu->id
            ]);

            DB::commit();
        });

    }
}
