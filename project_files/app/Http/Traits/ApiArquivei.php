<?php


namespace App\Http\Traits;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

trait ApiArquivei
{

    // Função de comunicação com a API Arquivei
    public function getXmlFromApi($access_key = false)
    {
        $url = env('ARQUIVEI_API_ENDPOINT')."/received";
        $client = new Client();
        $query = [];

        $params = [
            'Content-Type' => 'application/json',
            'x-api-id' => env('ARQUIVEI_API_ID'),
            'x-api-key' => env('ARQUIVEI_API_KEY'),
        ];

        if($access_key) {
            $query = [
                'access_key[]' => $access_key
            ];
        }

        $promise = $client->requestAsync('GET', $url, ['query' => $query, 'headers' => $params])
            ->then(
                function (ResponseInterface $res) {
                    return $res->getBody()->getContents();
                },
                function (RequestException $e) {
                    return $e->getMessage();
                }
            );

        $response = json_decode($promise->wait());

        return $response->data;
    }

}