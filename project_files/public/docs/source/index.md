---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://arquivei.test/docs/collection.json)

<!-- END_INFO -->

#API Arquivei

Obtem dados pela API Arquivei, arquiva em banco próprio e retorna os valores
<!-- START_69ecf6ea2b0d64396ad0caf95ac719b2 -->
## Obter valor de uma nota pela chave de acesso.

Verifica se uma chave de acesso já está com seu valor cadastrado no banco, se tiver o retorna, senão, requisita
para a API Arquivei, grava em banco e retorna o valor.

> Example request:

```bash
curl -X GET -G "http://arquivei.test/api/xml" \
    -H "Content-Type: application/json" \
    -d '{"api-token":"sed","access_key":"odit"}'

```

```javascript
const url = new URL("http://arquivei.test/api/xml");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "api-token": "sed",
    "access_key": "odit"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "success": false,
    "error": "API Token Inválido"
}
```

### HTTP Request
`GET api/xml`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    api-token | string |  required  | API TOKEN precisa ser enviado no cabeçalho da requisição.
    access_key | string |  required  | Chave de Acesso.

<!-- END_69ecf6ea2b0d64396ad0caf95ac719b2 -->

<!-- START_526aa670509e8f8f150f692941c36a6c -->
## Provisionar todas as notas da API.

Busca as notas disponíveis na API da Arquivei e as grava em banco de dados, tornando-as disponíveis para consulta
direta

> Example request:

```bash
curl -X GET -G "http://arquivei.test/api/provide" \
    -H "Content-Type: application/json" \
    -d '{"api-token":"quam"}'

```

```javascript
const url = new URL("http://arquivei.test/api/provide");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "api-token": "quam"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "success": false,
    "error": "API Token Inválido"
}
```

### HTTP Request
`GET api/provide`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    api-token | string |  required  | API TOKEN precisa ser enviado no cabeçalho da requisição.

<!-- END_526aa670509e8f8f150f692941c36a6c -->


