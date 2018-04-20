<?php

namespace App\Rules\Admin\Clase;

use Illuminate\Contracts\Validation\Rule;

class HorarioDocente implements Rule
{
    public $dia;
    public $hora_entrada;
    public $hora_salida;
    public $periodo_id;
    public $docente_id;
    public $clase_id;
    public $materia;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($validate)
    {
        $this->dia             = $validate['dia'];
        $this->hora_entrada    = $validate['hora_entrada'];
        $this->hora_salida     = $validate['hora_salida'];
        $this->periodo_id      = $validate['periodo_id'];
        $this->docente_id      = $validate['docente_id'];

        if (isset($validate['clase_id'])) {
            $this->clase_id    = $validate['clase_id'];
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($clase_id) {
            $clases_docente = Clase::where([
                ['docente_id',$this->docente_id],
                ['periodo_id',$this->periodo_id],
                ['id','<>',$this->clase_id]
            ])->get();    
        }else{
            $clases_docente = Clase::where([
                ['docente_id',$this->docente_id],
                ['periodo_id',$this->periodo_id]
            ])->get();
        }
        
        $horarios_docente = [];
        foreach ($clases_docente as $key => $clase_docente) {
            $horarios = $clase_docente->horarios;
            foreach ($horarios as $key => $horario) {
                array_push($horarios_docente,$horario);
            }
        }

        foreach ($this->dia as $key => $dia_value) {
            
            if (isset($this->hora_inicio[$dia_value]) && isset($this->hora_salida[$dia_value])) {
                
                foreach ($horarios_docente as $key_h => $horario_docente) {

                    if ( ($horario_docente->dia_id-1) == $dia_value ) {

                        $h_e = date("H:i:s", strtotime($this->hora_inicio[$dia_value]));
                        $h_s = date("H:i:s", strtotime($this->hora_salida[$dia_value]));

                        $h_e_a = date("H:i:s", strtotime($horario_docente->hora_entrada));
                        $h_s_a = date("H:i:s", strtotime($horario_docente->hora_salida));

                        if(
                            $h_e >= $horario_docente->hora_entrada &&
                            $h_e < $horario_docente->hora_salida
                        ){
                            
                            $asignatura = $horario_docente->clase->asignatura->asignatura;
                            $especialidad = $horario_docente->clase->especialidad->especialidad;
                            $clase = $horario_docente->clase->clase;

                            $this->materia = $asignatura.' ['. $clase .'] - '.$especialidad;

                            $horario_valido = false ;  
                        } 
                        if(
                            $h_s > $horario_docente->hora_entrada &&
                            $h_s <= $horario_docente->hora_salida
                        ){
                            $asignatura = $horario_docente->clase->asignatura->asignatura;
                            $especialidad = $horario_docente->clase->especialidad->especialidad;
                            $clase = $horario_docente->clase->clase;

                            $this->materia = $asignatura.' ['. $clase .'] - '.$especialidad;

                            $horario_valido = false ;
                        }
                        if(
                            $h_e <= $horario_docente->hora_entrada &&
                            $h_s >= $horario_docente->hora_salida
                        ){
                            $asignatura = $horario_docente->clase->asignatura->asignatura;
                            $especialidad = $horario_docente->clase->especialidad->especialidad;
                            $clase = $horario_docente->clase->clase;

                            $this->materia = $asignatura.' ['. $clase .'] - '.$especialidad;
                            
                            $horario_valido = false;
                        }
                    }
                }
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
