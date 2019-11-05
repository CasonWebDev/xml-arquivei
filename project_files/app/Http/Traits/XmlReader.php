<?php


namespace App\Http\Traits;

use Orchestra\Parser\Xml\Facade as XmlParser;

Trait XmlReader
{
    // Função de leitura do XML
    public function xmlReader($base)
    {
        // Decodifica o XML recebido em base64 e extrai seu conteúdo
        $xml = XmlParser::extract(base64_decode($base));

        // Sintetiza em um array os dados desejados obtidos do XML (para dois tipos de XML possíveis)
        $data = $xml->parse([
            'access_key' => ['uses' => 'infNFe::Id'],
            'total' => ['uses' => 'infNFe.total.ICMSTot.vNF']
        ]);
        if(empty($data['access_key'])) {
            $data = $xml->parse([
                'access_key' => ['uses' => 'NFe.infNFe::Id'],
                'total' => ['uses' => 'NFe.infNFe.total.ICMSTot.vNF']
            ]);
        }

        // Remove o prefixo NFe da chave de acesso recebida pelo XML
        $data['access_key'] = str_replace('NFe','',$data['access_key']);

        // Retorna o array
        return $data;
    }
}