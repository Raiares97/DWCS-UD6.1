<?php

use App\Kernel;
use Symfony\Component\HttpClient\HttpClient;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

$presupuesto = HttpClient::create();

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

//El ID es cuatro porque la generación de la base de datos, como estuve con entradas hechas a mano,
// contabilizó ID ya usados.
getPresupuesto($presupuesto, 4);

//Tendria que crear una llamada a la base de datos para saber que id le corresponde a la siguiente entrada, por
//ahora tiene ese valor porque yo he consultdo mi db y es el siguiente.
crearPresupuesto($presupuesto,["id"=>8, "Nombre"=>"Lorena","Total"=>27,99]);

function getPresupuesto($presupuesto, $id){
    $response = $presupuesto->request('GET',"http://127.0.0.1:8000/api/presupuestos". "/$id"
    );
    procesarResponse($response);
}

function crearPresupuesto($client, $data)
{
    $response = $client->request('POST', "http://127.0.0.1:8000/api/presupuestos", ['json' => $data]);
    procesarResponse($response);
}

function procesarResponse($response)
{
    //obtener código respuesta
    $statusCode = $response->getStatusCode();
    // $statusCode = 200
    echo $statusCode;
    echo "<br/>";

    $content = $response->getContent(); //obtiene un String
    if (!empty($content)) {
        $content = $response->toArray(); // se transforma a un array asociativo

        mostrar_json($content);

        // $contentType = 'application/json'
        $contentType = $response->getHeaders()['content-type'][0];
        echo $contentType;
        echo "<br/>";
    }
}