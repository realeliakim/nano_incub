<p align="center">
  <img src="https://nanoincub.com.br/wp-content/uploads/2021/09/cropped-nanoincub-logo.png" alt="nanoIncub_logo" height="80"/>
</p>
<h1 align="center">
  Nano Incub
</h1>

<p align="center">
  <a href="https://www.linkedin.com/in/realeliakim/">
    <img alt="Linkedin" src="https://img.shields.io/badge/-Eliakim%20Aquino-0e76a8?label=Linkedin&logo=linkedin&style=flat-square"/>
  </a>
</p>


## :computer: Instalação

```bash
# Clone este repositório.
$ git clone git@github.com:realeliakim/nano_incub_teste.git

# Vá para a pasta do projeto
$ cd nano_incub_teste

# Instale todas as dependências
$ composer update -vvv
$ npm install
$ npm run dev

#Banco de dados
Renomei o arquivo env.example para .env e insira suas credenciais do banco

#Migrations
$ php artisan migrate

# Execute a aplicação
$ php artisan serve

```

## Rotas

> [GET] /buscar -> Pesquisa informações do funcionario
> [GET] /buscar/movimentacao -> Pesquisa informações da movimentação para funcionário

#rota de funcionarios

> [GET] /extrato/{id} -> Lista o extrato de movimentação de um determinado funcionário 
> [GET] /funcionarios/criar' -> Abre o formulário para criar um funcionário
> [POST] /funcionarios -> Processa os dados enviados e salva o funcionário      
> [GET] /funcionarios/editar/{id} -> Abre o formulário para editar um determinado funcionário 
> [PUT] /funcionarios/{id} -> Processa os dados enviados e atualiza as informações de um funcionário {id}', > [DELETE] /funcionarios/remover/{id} -> Exclui um funcionário com todas suas movimentações

#rota de movimentacoes

> [GET] /movimentacoes -> Lista todas as movimentações cadastradas
> [GET] /movimentacoes/criar -> Abre um formulário para criar uma movimentação para um funcionário
> [POST] /movimentacoes -> Processa os dados enviados pelo formulário e salva no banco
> [GET] /movimentacoes/editar/{id} -> Abre um formulário para editar uma determinação
> [PUT] /movimentacoes/{id} -> Processa os dados enviados e atualiza as informações de uma movimentação
> [DELETE] /movimentacoes/remover/{id} -> Exclui uma movimentação

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
