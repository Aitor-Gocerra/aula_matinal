<?php

require_once(CONFIG . '/jwt_helper.php');

class CPanelAdmin{

    public $obj_modelo;
    public $vista;

    public function __construct(){
        require_once(RUTA_MODELOS.'PanelAdmin.php');
        $this->obj_modelo = new MPanelAdmin();
    }

    public function inicio(){
        $this->vista = 'vPanelAdmin';
        $resultado = $this->obj_modelo->num_inscripcionespendientes();
        $resultado['nombre_usuario'] = jwt_get_nombre();
        return $resultado;
    }
}
?>