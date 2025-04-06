<?php

(!empty($_POST["cedula1"])) ? $cedu = $_POST["cedula1"] : null;
(!empty($_POST["cedula2"])) ? $cedu2 = $_POST["cedula2"] : null;
(!empty($_POST["nombre2"])) ? $nombre2 = $_POST["nombre2"] : null;
(!empty($_POST["apellido2"])) ? $apellido2 = $_POST["apellido2"] : null;
(!empty($_POST["password2"])) ? $password2 = password_hash($_POST["password2"], PASSWORD_BCRYPT) : null;
(!empty($_POST["nombre_usuario2"])) ? $username2 = $_POST["nombre_usuario2"] : null;
(!empty($_POST["rol"])) ? $rol = $_POST["rol"] : null;
(!empty($_POST["rol2"])) ? $rol2 = $_POST["rol2"] : null;
(!empty($_POST["nacionalidad2"])) ? $nacionalidad2 = $_POST["nacionalidad2"] : null;

class UserController
{

    private $model;
    function __construct()
    {
        $server = dirname(__DIR__, 1);
        include_once "$server/models/userModel.php";
        $this->model = new UserModel();
    }
    function SelectRol()
    {
        $array = $this->model->selectRol();
        foreach ($array as $row) {
            if ($row[0] === 2220) {
                continue;
            }
            echo "<option value='$row[0]'>$row[1]</option>";
        }
    }
    
    function ShowUser()
    {
        $array = $this->model->User();
        echo "
        <thead class='bg-primary'>
            <tr>
                <th class='text-center'>ID</th>
                <th class='text-center'>CÉDULA</th>
                <th class='text-center'>NOMBRE</th>
                <th class='text-center'>APELLIDO</th>
                <th class='text-center'>NOMBRE USUARIO</th>
                <th class='text-center'>ROL</th>
                <th class='text-center'>IMAGEN</th>
                <th class='text-center'>OPCIONES</th>
            </tr>
        </thead>
        <tbody>
        ";
        $i = 0;
        $i2 = 0;
        if ($array) {
            foreach ($array as $row) {
                (!empty($row[0])) ? $i2++ : null;
                echo "
            <tr>
                <td class='text-center'>" . $i2 . "</td>
                <td class='text-center'>" . $row[6] . "-" . $row[0] . "</td>
                <td class='text-center'>" . $row[1] . "</td>
                <td class='text-center'>" . $row[2] . "</td>
                <td class='text-center'>" . $row[4] . "</td>
                <td class='text-center'>" . strtoupper($row[5]) . "</td>
                <td class='text-center'>";

                //Modal Mostrar Foto
                if (!empty($row[8])) {
                echo"

                <button type='button' title='Ver foto' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#modalFoto" . $row[0] . "'>
                        <i class='fa-solid fa-image'></i>
                </button>
                
                <div class='modal fade' id='modalFoto" . $row[0] . "' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-scrollable'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                            <h1 class='modal-title text-dark fs-5' id='staticBackdropLabel'>FOTO DE PERFIL DE " . $row[1] . "</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <img src='/FUNDEY/app/views/usuarios/".$row[8]."' class='imagenDePerfil rounded'>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>";
        }else{
            echo"
            NO HAY FOTO</td>";
        }
                // modal editar
                echo "
                    <td class='text-center'>
                    <!-- Button trigger modal editar -->
                    <button type='button' title='Editar usuario' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#staticBackdrop1" . $row[0] . "'>
                        <i class='fa-solid fa-pen-to-square'></i>
                    </button>
                    <!-- Modal Editar -->
            <div class='modal fade' id='staticBackdrop1" . $row[0] . "' data-bs-backdrop='static'
                data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-scrollable'>
                    <div class='modal-content bg-white'>
                        <div class='modal-header'>
                            <h1 class='modal-title text-dark fs-5' id='staticBackdropLabel'>EDITAR REGISTRO " . $row[0] . "</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <form action='../../controllers/userController.php' method='POST' class='d-flex flex-column' enctype='multipart/form-data' id='userEdit" . $row[0] . "'>
                                <div class='cedulerNacio col-11 position-relative'>
                                    <select name='nacionalidad2' id='nacionalidad" . $i++ . "'
                                        class='position-absolute end-0 nacio z-5 btn btn-success' hidden readonly>
                                        <option value='V'>V
                                        </option>
                                        <option value='E'>E
                                        </option>
                                    </select>
                                    <input type='number' name='cedula2' id='cedula" . $i++ . "' placeholder='Cédula'
                                        class='mx-3 bg-transparent col-12 text-dark input' required
                                        value='" . $row[0] . "' hidden readonly>
                                </div>
                                <input type='text' name='nombre2' id='nombre" . $i++ . "'
                                    placeholder='Nombre'
                                    class='mx-3 bg-transparent col-11 text-dark input upper' required
                                    value='" . $row[1] . "'>
                                <input type='text' name='apellido2' id='apellido" . $i++ . "'
                                    placeholder='Apellido'
                                    class='mx-3 bg-transparent col-11 text-dark input upper' required
                                    value='" . $row[2] . "'>
                                <input type='password' name='password2' id='password" . $i++ . "'
                                    placeholder='Contraseña' class='mx-3 bg-transparent col-11 text-dark input'
                                    required>
                                <input type='text' name='nombre_usuario2' id='nombre_usuario" . $i++ . "' placeholder='Usuario'
                                    class='mx-3 input upper text-dark bg-transparent col-11'
                                    value='" . $row[4] . "'>
                                <div class='d-flex flex-column'>
                                    <label for='Roles'>NOMBRE DEL ROL</label>
                                    <select class='btn border-dark' name='rol2'>";
                                        $this->SelectRol();
                                    echo "
                                    </select>
                                </div>
                                    <label for='foto2'>FOTO DE PERFIL</label>
                                    <input type='file' name='foto2' id='foto2" . $i++ . "' class='mx-3 input text-dark bg-transparent col-11' value='".$row[8]."'>
                            </form>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Cancelar</button>
                            <input type='submit' value='Actualizar' class='btn btn-primary' form='userEdit$row[0]'>
                        </div>
                    </div>
                </div>
            </div>
                    ";


                // modal eliminar
                echo " 
                    <!-- Button trigger modal eliminar -->
                    <button type='button' title='Eliminar usuario' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#staticBackdrop" . $row[0] . "'>
                        <i class='fa-solid fa-trash'></i>
                    </button>
                    <!-- Modal Eliminar -->
            <div class='modal fade' id='staticBackdrop$row[0]' data-bs-backdrop='static' data-bs-keyboard='false'
                tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content bg-withe'>
                        <div class='modal-header'>
                            <h1 class='modal-title text-dark fs-5' id='staticBackdropLabel'>ELIMINAR</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <p>ESTÁ SEGURO DE QUE DESEA ELIMINAR EL REGISTRO $row[0]?</p>
                        </div>
                        <div class='modal-footer'>
                            <form action='../../controllers/userController.php' method='POST' class='d-flex'>
                                <input type='number' name='cedula1' id='cedula" . $i++ . "'
                                    class='mx-3 bg-transparent col-12 text-white m-4 p-2' hidden value='$row[0]'>
                                <button type='button' class='btn btn-light mx-2'
                                    data-bs-dismiss='modal'>Cancelar</button>
                                <input type='submit' class='btn btn-danger mx-2' value='Eliminar'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                </td>";
            }
            echo "
        </tr>
    </tbody>";
        }
    }


    function SaveUser($cedula, $nombre, $apellido, $password, $username, $rol, $nacionalidad, $imagen)
    {
        $guarder = $this->model->InsertUser($cedula, $nombre, $apellido, $password, $username, $rol, $nacionalidad,  $imagen);
        ($guarder) ? header("location: ../views/usuarios/usuarios.php?Cedula0=" . $cedula) : header("location: ../views/usuarios/usuarios.php?Cedula0=err");
    }
    function EliminateUser($cedu)
    {
        $eliminater = $this->model->DeleteUser($cedu);
        ($eliminater) ? header("location: ../views/usuarios/usuarios.php?Cedula1=" . $cedu) : header("location: ../views/usuarios/usuarios.php?Cedula1=err");
    }
    function EditerUser($cedu2, $nombre2, $apellido2, $password2, $username2, $rol2, $nacionalidad2, $imagen2)
    {
        $editer = $this->model->EditUser($cedu2, $nombre2, $apellido2, $password2, $username2, $rol2, $nacionalidad2, $imagen2);
        ($editer) ? header("location: ../views/usuarios/usuarios.php?Cedula2=" . $cedu2 ) : header("location: ../views/usuarios/usuarios.php?Cedula2=err");
    }
}
$obj = new UserController();
//Validaciones para la fotos
    $imagen = "";
    if (isset($_FILES["img"])){
        $foto = $_FILES["img"];
        $nombreF = $foto["name"];
        $tipo = $foto["type"];
        $ruta_Original = $foto["tmp_name"];
        $tamaño = $foto["size"];
        $carpeta ='../views/usuarios/fotos/'; 

                if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png'){
                    header("location: ../views/usuarios/usuarios.php?img=err");
                } else if($tamaño > 5*1024*1024){
                    header("location: ../views/usuarios/usuarios.php?tamaño=err" );
                }else{
                    $direccion = $carpeta.$nombreF;
                    move_uploaded_file($ruta_Original, $direccion);
                    $imagen = "fotos/$nombreF";
                }
            } 
            if (!empty($_POST["cedula"]) and !empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["contraseña"]) and !empty($_POST["usuario"]) and !empty($_POST["id_rol"]) and !empty($_POST["nacionalidad"])) {
                require '../config/cadenas.php';
                $limpiar = new LimpiarCadenas();
                $cedula = $limpiar->limpiarCadena($_POST["cedula"]);
                $nombre = $limpiar->limpiarCadena($_POST["nombre"]);
                $apellido = $limpiar->limpiarCadena($_POST["apellido"]);
                $contraseña = $_POST["contraseña"];
                $contraseña2 = $_POST["contraseña2"];
                $usuario = $limpiar->limpiarCadena($_POST["usuario"]);
                if ($limpiar->verificar_datos('\d{7,8}$', $cedula) || $limpiar->verificar_datos('[a-zA-ZÀ-ÿ]{1,40}$', $nombre) || $limpiar->verificar_datos('[a-zA-ZÀ-ÿ]{1,40}$', $apellido) || $limpiar->verificar_datos('[a-zA-Z0-9\_\-]{4,16}$', $contraseña) || $limpiar->verificar_datos('[a-zA-Z0-9\_\-]{4,16}$', $usuario) || $contraseña !== $contraseña2) {
                    header('location: ../views/usuarios/usuarios.php?form=err');
                }else{
                    $obj->SaveUser($cedula, $nombre, $apellido, password_hash($contraseña, PASSWORD_BCRYPT), $usuario, intval($_POST["id_rol"]), $_POST["nacionalidad"], $imagen);
                }
            }
    
if (!empty($cedu)) {
    $obj->EliminateUser(intval($cedu));
}


if (!empty($cedu2) and !empty($nombre2) and !empty($apellido2) and !empty($password2) and !empty($username2) and !empty($rol2) and !empty($nacionalidad2)) {
    require '../config/cadenas.php';
    $limpiar = new LimpiarCadenas();
    $cedu2 = $limpiar->limpiarCadena($cedu2);
    $nombre2 = $limpiar->limpiarCadena($nombre2);
    $password2 = $password2;
    $apellido2 = $limpiar->limpiarCadena($apellido2);
    $username2 = $limpiar->limpiarCadena($username2);


    //Validaciones para la fotos
    $imagen2 = "";
    if (isset($_FILES["foto2"])){
        $foto = $_FILES["foto2"];
        $nombreF = $foto["name"];
        $tipo = $foto["type"];
        $ruta_Original = $foto["tmp_name"];
        $tamaño = $foto["size"];
        $carpeta ='../views/usuarios/fotos/'; 

                if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png'){
                    header("location: ../views/usuarios/usuarios.php?img=err");
                } else if($tamaño > 5*1024*1024){
                    header("location: ../views/usuarios/usuarios.php?tamaño=err" );
                }else{
                    $direccion = $carpeta.$nombreF;
                    move_uploaded_file($ruta_Original, $direccion);
                    $imagen2 = "fotos/$nombreF";
                } 
            }
    if ($limpiar->verificar_datos('\d{7,8}$', $cedu2) || $limpiar->verificar_datos('[a-zA-ZÀ-ÿ]{1,40}$', $nombre2) || $limpiar->verificar_datos('[a-zA-ZÀ-ÿ]{1,40}$', $apellido2) || $limpiar->verificar_datos('[a-zA-Z0-9\_\-]{4,16}$', $username2)) {
            header('location: ../views/usuarios/usuarios.php?form=err');
        }else{
            $obj->EditerUser($cedu2, $nombre2, $apellido2, $password2, $username2, $rol2, $nacionalidad2, $imagen2); 
        } 
}
