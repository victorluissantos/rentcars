# 🚗 Sistema de Busca de Veículos
Rentcars | Desafio Técnico | Senior Developer Analyst

Este projeto consiste em um sistema que busca veículos de locadoras utilizando Laravel no backend e JSON Server para simular APIs de locadoras.

## 📌 Requisitos

- **Docker** e **Docker Compose** instalados
- **PHP 8+** com Composer (caso queira rodar fora do contêiner)
- **Node.js** (para rodar o JSON Server localmente, se necessário)

## 🚀 Configuração do Projeto

### 1️⃣ Clonar o Repositório
```bash
git clone https://github.com/victorluissantos/rentcars.git
cd rentcars
```

### 2️⃣ Configurar as Variáveis de Ambiente
Crie o arquivo `.env` baseado no `.env.example`:
```bash
cp .env.example .env
```
Atualize as configurações do banco de dados no `.env`, caso necessário.

### 3️⃣ Subir os Containers
```bash
docker-compose up -d --build
```
Isso iniciará:
- O Laravel com Apache e PHP
- O banco de dados (MySQL ou PostgreSQL, dependendo da configuração)
- O JSON Server simulando as APIs das locadoras

### 4️⃣ Instalar Dependências, Migrar o Banco e Popular os Dados
```bash
docker exec -it php-apache bash
composer install
php artisan migrate --seed
```
Isso cria as tabelas e popula a tabela `locadoras` com dois registros iniciais.

## 📌 Importação de Endpoints no Postman

Para facilitar os testes da API, disponibilizamos o arquivo `postman-backend-api.json` na raiz do projeto. Você pode importá-lo no Postman seguindo os passos abaixo:

1. Abra o Postman.
2. Vá para **File > Import**.
3. Selecione **Upload Files** e escolha `postman-backend-api.json`.
4. Clique em **Import**.

Isso adicionará automaticamente os endpoints do backend no Postman para facilitar os testes.

## 🛠 Endpoints da API

### 🔍 Pesquisar Veículos
- **Rota:** `GET /api/pesquisa`
- **Resposta:**
```json
{
  "veiculos": [
    {
      "id": 1,
      "nome": "Chevrolet Onix",
      "categoria": "Econômico",
      "preco": 120,
      "locadora": {
        "id": 1,
        "nome": "Locadora 1"
      }
    }
  ]
}
```

## 🌐 APIs das Locadoras

No total, disponibilizamos **4 URLs de API** para consumo das locadoras. As portas disponíveis são **3001, 3002, 3003 e 3004**. 

A seed está configurada para utilizar as APIs das portas **3001, 3002 e 3003**, deixando a porta **3004 livre para testes** manuais.

Exemplo de URL para consulta de veículos:
```bash
http://json-server:3001/veiculos
```

## 🚨 Erros e Soluções

- **Erro: "Failed to connect to localhost"**
  - Solução: Use o nome do container no lugar de `localhost`, por exemplo: `http://json-server:3001/veiculos`.

- **Erro: "Permission denied" ao rodar o Artisan**
  - Solução: Verifique as permissões do diretório `storage` e `bootstrap/cache`:
  ```bash
  chmod -R 777 storage bootstrap/cache
  ```

## 📝 Licença

Este projeto está sob a licença MIT. Sinta-se livre para contribuir! 🚀

