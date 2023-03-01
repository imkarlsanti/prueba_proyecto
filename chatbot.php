Header add Access-Control-Allow-Origin "*"
Header add Access-Control-Allow-Headers "origin, x-requested-with, content-type"
Header add Access-Control-Allow-Methods "PUT, GET, POST, DELETE, OPTIONS"

<?php
// Obtener el mensaje enviado por el usuario
$message = $_POST['message'];

// Enviar una solicitud HTTP a la API de OpenAI para obtener una respuesta
$url = 'https://api.openai.com/v1/engines/davinci-003/completions';
$data = array(
    'prompt' => $message,
    'max_tokens' => 4000,
    'n' => 1,
    'stop' => '\n',
    'temperature' => 0.5
);
$options = array(
    'http' => array(
        'header' => 'Content-Type: application/json',
        'method' => 'POST',
        'content' => json_encode($data),
        'Authorization' => 'Bearer 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',
    ),
);
$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

// Decodificar la respuesta JSON y extraer la respuesta del chatbot
$decoded = json_decode($response, true);
$chatbot_response = $decoded['choices'][0]['text'];

// Devolver la respuesta del chatbot en formato JSON
echo json_encode(array('message' => $chatbot_response));
?>
