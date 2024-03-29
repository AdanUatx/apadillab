<?php

class WebServiceController
{
    public function consumirWebService(){
        // URL del servicio remoto
        $url = 'https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF343410/datos/oportuno';

        // Token de autenticación proporcionado por Banxico
        $token = '0dd228cb6f0d7f07782a3f955ae9b529ca839a110b24074e0db375a4c9aa17cf';

        // Inicializar cURL
        $ch = curl_init();

        // Configurar las opciones de la solicitud
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Bmx-Token: ' . $token,
            'Accept: application/json'
        ));

        // Realizar la solicitud y obtener la respuesta
        $response = curl_exec($ch);

        // Verificar si hubo algún error en la solicitud
        if (curl_errno($ch)) {
            http_response_code(500);
            return array('success' => false, 'message' => 'Error al realizar la solicitud: ' . curl_error($ch));
            exit();
        }

        // Decodificar la respuesta JSON
        $data = json_decode($response, true);

        // Verificar si la solicitud fue exitosa y procesar la respuesta
        if ($data !== null && isset($data['bmx']['series'][0]['datos'][0]['dato'])) {
            $tipo_cambio = $data['bmx']['series'][0]['datos'][0]['dato'];
            return array(
                'success' => true,
                'tipo_cambio' => $tipo_cambio
            );
        } else {
            http_response_code(500);
            return array(
                'success' => true,
                'msg' => 'Error al obtener el tipo de cambio'
            );
        }

        // Cerrar cURL
        curl_close($ch);
    }
}