<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiArquivei;
use App\Http\Traits\XmlReader;
use App\Nfs;
use Illuminate\Http\Request;

/**
 * @group API Arquivei
 * Obtem dados pela API Arquivei, arquiva em banco próprio e retorna os valores
 * @package App\Http\Controllers
 */
class Arquivei extends Controller
{
    use ApiArquivei, XmlReader;

    /**
     * Obter valor de uma nota pela chave de acesso.
     * Verifica se uma chave de acesso já está com seu valor cadastrado no banco, se tiver o retorna, senão, requisita
     * para a API Arquivei, grava em banco e retorna o valor.
     *
     * @bodyParam api-token string required API TOKEN precisa ser enviado no cabeçalho da requisição.
     * @bodyParam access_key string required Chave de Acesso.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getXml(Request $request)
    {

        // Requisita o registro junto ao banco de dados
        $nf = Nfs::getNf($request->access_key);

        // Verifica se o banco retornou um valor, se sim, retorna o registro, se não, continua a executar.
        if($nf){
            return response()->json($nf);
        }

        // Realiza requisição á API Arquivei enviando como parâmetro a chave de acesso
        $nfes = $this->getXmlFromApi($request->access_key);

        // Faz a leitura do XML recebido via base65
        $dataXml = $this->xmlReader($nfes[0]->xml);

        // Grava os dados recebidos do leitor de XML no banco
        $dataXmlDb = Nfs::setNf($dataXml);

        // Retorna os dados recém obtidos e gravados do XML
        return response()
                ->json($dataXmlDb, 200);

    }

    /**
     * Provisionar todas as notas da API.
     * Busca as notas disponíveis na API da Arquivei e as grava em banco de dados, tornando-as disponíveis para consulta
     * direta
     *
     * @bodyParam api-token string required API TOKEN precisa ser enviado no cabeçalho da requisição.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function runXml()
    {
        // Realiza requisição á API Arquivei, trazendo todos os registros disponíveis
        $nfes = $this->getXmlFromApi();

        // Realiza um simples laço nesses registros, lendo os dados do XML e gravando-os em banco
        foreach($nfes as $nfs){
            $dataXml = $this->xmlReader($nfs->xml);
            Nfs::setNf($dataXml);
        }

        // Retorna uma mensagem caso tudo ocorra bem
        return response()
                ->json(['message' => 'XMLs processados com sucesso!'], 200);
    }
}
