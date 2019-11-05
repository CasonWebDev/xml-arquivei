
# API Integração XML de NFs Arquivei

### Instalação

A aplicação está configurada para rodar via docker, para isso basta subir com o comando:

> docker-compose up -d

Após isso, alterar o arquivo .env padrão alterando ou adicionando as seguintes variáveis
```
DB_HOST=teste-arquivei-mysql  
DB_PORT=3306  
DB_DATABASE=teste-arquivei  
DB_USERNAME=cason  
DB_PASSWORD=root

ARQUIVEI_API_ID=f96ae22f7c5d74fa4d78e764563d52811570588e  
ARQUIVEI_API_KEY=cc79ee9464257c9e1901703e04ac9f86b0f387c2  
ARQUIVEI_API_ENDPOINT=https://sandbox-api.arquivei.com.br/v1/nfe  
  
API_TOKEN=40bbecb2ef64a31cf9eef949b4abcacd133a8767
```
##### Preferencialmente configure para rodar na URL: http://arquivei.test (tanto a variável APP_URL no arquivo ENV quanto no arquivo HOSTS)

Acesse a bash da aplicação com o comando
> docker-compose exec teste-arquivei-app bash

Entre na pasta project_files e rode o comando
> composer install

Com isso a aplicação estará pronta para rodar, acesse a URL configurada da seguinte forma para acessar a documentação:
> http://url-aplicacao/docs

Antes de testar, rode a migration para criar a tabela no banco de dados
> php artisan migrate

Feito isso, provavelmente já será possível executar os 2 endpoints disponíveis, para saber sobre eles basta ler a documentação e os comentários no código.

### Muito Obrigado