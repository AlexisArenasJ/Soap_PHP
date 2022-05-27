<?php   

require __DIR__.'/vendor/autoload.php';
require_once "vendor/econea/nusoap/src/nusoap.php";

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$namespace = "crudSoap.upt";
$server = new soap_server();
$server->configureWSDL("WSDL",$namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

// SE CREA EL USUARIO
$server->wsdl->addComplexType(
    'crearUsuario',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'apPaterno' => array('name' => 'apPaterno', 'type'=>'xsd:string'),
        'apMaterno' => array('name' => 'apMaterno', 'type'=>'xsd:string'),
        'nombre' => array('name' => 'nombre', 'type'=>'xsd:string'),
        'correo' => array('name' => 'correo', 'type'=>'xsd:string'),
        'contrasenia' => array('name' => 'contrasenia', 'type'=>'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'response',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'usuario' => array('name'=>'usuario', 'type'=>'xsd:string'),
        'estatus' => array('name'=>'estatus', 'type'=>'xsd:string'),
    )
);

$server->register(
    'createUser',
    array('name' => 'tns:crearUsuario'),
    array('name' => 'tns:response'),
    $namespace,
    false,
    'rpc',
    'encoded',
    'Recibe una usuario y regresa un boleano'
);

function createUser($request){
    $urlInsert = "https://soapproyect-default-rtdb.firebaseio.com/crearUsuario.json";

    $dataAplicacion = '{
            "apPaterno":"'.$request["apPaterno"].'",
            "apMaterno":"'.$request["apMaterno"].'",
            "nombre":"'.$request["nombre"].'",
            "correo":"'.$request["correo"].'",
            "contrasenia":"'.$request["contrasenia"].'"
        }';
        $chAplicacion = curl_init();
        
        curl_setopt($chAplicacion, CURLOPT_URL, $urlInsert);
        curl_setopt($chAplicacion, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chAplicacion, CURLOPT_POST, 1);
        curl_setopt($chAplicacion, CURLOPT_POSTFIELDS, $dataAplicacion);
        curl_setopt($chAplicacion, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
        
        $responseAp = curl_exec($chAplicacion);
        /* Codigo */
        //curl_close($chAplicacion);
        $resultado = json_decode($responseAp);
        //return $resultado->name;
        /* Codigo */
        if (curl_errno($chAplicacion)) {
            echo 'Error' . curl_errno($chAplicacion);
        }


    return array(
        "estatus" => "El usuario ha sido creado");
}

// SE LOGEA EL USUARIO
$server->wsdl->addComplexType(
    'getUsuario',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'correo' => array('name' => 'correo', 'type'=>'xsd:string'),
        'contrasenia' => array('name' => 'contrasenia', 'type'=>'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'response',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'usuario' => array('name'=>'usuario', 'type'=>'xsd:string'),
        'estatus' => array('name'=>'estatus', 'type'=>'xsd:string')
    )
);

$server->register(
    'login',
    array('name' => 'tns:getUsuario'),
    array('name' => 'tns:response'),
    $namespace,
    false,
    'rpc',
    'encoded',
    'Recibe una usuario y regresa un boleano'
);

function login($request){
    return array(
        'usuario' => "Los datos son ".$request["apPaterno"]." ".$request["apMaterno"]." ".$request["nombre"],
        "estatus" => "El usuario se logeo");
}

// SE ACTUALIZA EL USUARIO
$server->wsdl->addComplexType(
    'updateUsuario',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'apPaterno' => array('name' => 'apPaterno', 'type'=>'xsd:string'),
        'apMaterno' => array('name' => 'apMaterno', 'type'=>'xsd:string'),
        'nombre' => array('name' => 'nombre', 'type'=>'xsd:string'),
        'correo' => array('name' => 'correo', 'type'=>'xsd:string'),
        'contrasenia' => array('name' => 'contrasenia', 'type'=>'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'response',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'usuario' => array('name'=>'usuario', 'type'=>'xsd:string'),
        'estatus' => array('name'=>'estatus', 'type'=>'xsd:string'),
    )
);

$server->register(
    'update',
    array('name' => 'tns:updateUsuario'),
    array('name' => 'tns:response'),
    $namespace,
    false,
    'rpc',
    'encoded',
    'Recibe una usuario y regresa un boleano'
);

function update($request){
    $urlUpdate = "https://soapproyect-default-rtdb.firebaseio.com/actualizarUsuario.json";

    $dataAplicacion = '{
        "apPaterno":"'.$request["apPaterno"].'",
        "apMaterno":"'.$request["apMaterno"].'",
        "nombre":"'.$request["nombre"].'",
        "correo":"'.$request["correo"].'",
        "contrasenia":"'.$request["contrasenia"].'"
    }';
    $chAplicacion = curl_init();
    
    curl_setopt($chAplicacion, CURLOPT_URL, $urlUpdate);
    curl_setopt($chAplicacion, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($chAplicacion, CURLOPT_POST, 1);
    curl_setopt($chAplicacion, CURLOPT_POSTFIELDS, $dataAplicacion);
    curl_setopt($chAplicacion, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
    
    $responseAp = curl_exec($chAplicacion);
    /* Codigo */
    //curl_close($chAplicacion);
    $resultado = json_decode($responseAp);
    //return $resultado->name;
    /* Codigo */
    if (curl_errno($chAplicacion)) {
        echo 'Error' . curl_errno($chAplicacion);
    }


return array(
    "estatus" => "El usuario ha sido creado");
}


// SE MANDA EL XML CON LAS OPCIONES
$POST_DATA = file_get_contents("php://input");
$server->service($POST_DATA);
exit();