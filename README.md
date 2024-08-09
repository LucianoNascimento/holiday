Configuração do Projeto Laravel 10
Requisitos
PHP: Versão 8.2 ou superior
Composer: Gerenciador de dependências do PHP
MySQL: Banco de dados principal
SQLite: Banco de dados para testes

1. Passos para Configuração

git clone https://github.com/LucianoNascimento/holiday
cd holiday

2. Instalar Dependências
  
   composer install
   
3. Configuração do Ambiente
   Copie o arquivo .env.example para .env:

Abra o arquivo .env e atualize as configurações do banco de dados e outras configurações necessárias. Por exemplo:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=holiday
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

DB_CONNECTION_TESTING=sqlite
DB_DATABASE_TESTING=:memory:

4. Gerar Chave da Aplicação
   php artisan migrate

5. Executar Testes
   Para executar os testes, use o seguinte comando:
   php artisan test

Rota: Listar todos os planos de férias
Método: GET
URL: /api/holiday-plans
Descrição: Retorna todos os planos de férias cadastrados.
Resposta de Sucesso (200)
{
"message": "Holiday plans retrieved successfully.",
"data": [
{
"id": 1,
"title": "Férias na praia",
"description": "Viagem para o litoral.",
"date": "2024-12-25",
"location": "Praia Grande",
"participants": "Família"
},
...
]

Rota: Criar um novo plano de férias
Método: POST
URL: /api/holiday-plans
Descrição: Cria um novo plano de férias com os dados fornecidos.
Dados do Corpo da Requisição:
{
"title": "string (required, max: 255)",
"description": "string (required)",
"date": "date (required, formato: Y-m-d)",
"location": "string (required, max: 255)",
"participants": "string (opcional, max: 255)"
}
Resposta de Sucesso (201):
{
"message": "Holiday plan created successfully.",
"data": {
"id": 1,
"title": "Férias na praia",
"description": "Viagem para o litoral.",
"date": "2024-12-25",
"location": "Praia Grande",
"participants": "Família"
}
}
{
"message": "Validation failed.",
"errors": {
"title": [
"The title field is required."
],
...
}
}
Rota: Exibir um plano de férias específico
Método: GET
URL: /api/holiday-plans/{id}
Descrição: Retorna um plano de férias específico com base no id fornecido.
Parâmetros da URL:
id: ID do plano de férias.
Resposta de Sucesso (200)
{
"message": "Holiday plan retrieved successfully.",
"data": {
"id": 1,
"title": "Férias na praia",
"description": "Viagem para o litoral.",
"date": "2024-12-25",
"location": "Praia Grande",
"participants": "Família"
}
}
ota: Atualizar um plano de férias
Método: PUT ou PATCH

URL: /api/holiday-plans/{id}

Descrição: Atualiza os dados de um plano de férias específico.

Parâmetros da URL:

id: ID do plano de férias.
Dados do Corpo da Requisição:
ota: Atualizar um plano de férias
Método: PUT ou PATCH

URL: /api/holiday-plans/{id}

Descrição: Atualiza os dados de um plano de férias específico.

Parâmetros da URL:

id: ID do plano de férias.
Dados do Corpo da Requisição:
{
"title": "string (required, max: 255)",
"description": "string (required)",
"date": "date (required, formato: Y-m-d)",
"location": "string (required, max: 255)",
"participants": "string (opcional, max: 255)"
}
Resposta de Sucesso (200):
{
"message": "Holiday plan updated successfully.",
"data": {
"id": 1,
"title": "Férias na montanha",
"description": "Viagem para a serra.",
"date": "2024-12-31",
"location": "Serra da Mantiqueira",
"participants": "Amigos"
}
}
Resposta de Falha(422)
{
"message": "Validation failed.",
"errors": {
"title": [
"The title field is required."
],
...
}
}
Rota: Deletar um plano de férias
Método: DELETE
URL: /api/holiday-plans/{id}
Descrição: Exclui um plano de férias específico.
Parâmetros da URL:
id: ID do plano de férias.
Resposta de Sucesso (204):
{
"message": "Holiday plan deleted successfully."
}
Rota: Gerar PDF de um plano de férias
Método: GET
URL: /api/holiday-plans/{id}/pdf
Descrição: Gera um PDF com os detalhes de um plano de férias específico.
Parâmetros da URL:
id: ID do plano de férias.
Resposta de Sucesso:
PDF gerado e baixado com o nome holiday_plan.pdf.

