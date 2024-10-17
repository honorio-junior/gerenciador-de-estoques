# Gerenciador de estoques

> Este projeto é um gerenciador de estoques desenvolvido em Laravel 11, projetado para facilitar o controle e a organização de produtos em diferentes estoques. O sistema permite a criação, edição e exclusão de estoques, categorias e produtos, proporcionando uma gestão eficiente e intuitiva.

![Exibir](https://i.imgur.com/hoQolRS.png)
![Editar](https://i.imgur.com/oaD6pMw.png)

Este gerenciador de estoques é um projeto simples, desenvolvido como parte de um estudo e para compor meu portfólio. Embora seja uma solução básica, oferece uma visão prática sobre como gerenciar produtos e estoques de forma eficiente.

## 🚀 Instalando usando Docker (para testes/desenvolvimento)

### 💻 Pré-requisitos

Antes de começar, verifique se você atendeu aos seguintes requisitos:

- Você instalou a versão mais recente do `Docker`

**Siga estas etapas:**

**1.** Clone o repositório e entre na pasta

```
git clone https://github.com/honorio-junior/gerenciador-de-estoques.git

cd gerenciador-de-estoques
```

**2.** Crie o .env necessário para o Laravel11

```
cp .env.example .env
```

**3.** Inicie o docker compose

```
docker compose up -d
```

**4.** Entre no container e baixe os pacotes necessários usando composer

```
docker compose exec app bash

composer install
```

**5.** Gere a chave e migração necessário para o Laravel

```
php artisan key:generate

php artisan migrate
```

**6.** Inicie o servidor de desenvolvimento Laravel

```
php artisan serve --host 0.0.0.0
```

O WebApp está disponível em [http://127.0.0.1:8000](http://127.0.0.1:8000)

