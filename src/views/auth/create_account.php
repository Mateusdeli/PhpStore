<div class="container">
    <div class="row">
      <div class="col-sm-6 offset-sm-3">
        <h3 class="text-center my-5">Registro de Novo Cliente</h3>

        <form action="?a=create_account" method="post">
            <div class="my-3">
                <label for="text_email">Email</label>
                <input type="email" name="text_email" id="text_email" placeholder="Email" class="form-control" required>
            </div>

            <div class="my-3">
                <label for="text_senha_1">Senha</label>
                <input type="password" name="text_senha_1" id="text_senha_1" placeholder="Senha" class="form-control" required>
            </div>

            <div class="my-3">
                <label for="text_senha_2">Confirmação da Senha</label>
                <input type="password" name="text_senha_2" id="text_senha_2" placeholder="Confirmacão da Senha" class="form-control" required>
            </div>

            <div class="my-3">
                <label for="text_nome_completo">Nome Completo</label>
                <input type="text" name="text_nome_completo" id="text_nome_completo" placeholder="Nome Completo" class="form-control">
            </div>

            <div class="my-3">
                <label for="text_endereco">Endereco</label>
                <input type="text" name="text_endereco" id="text_endereco" placeholder="Endereco" class="form-control">
            </div>

            <div class="my-3">
                <label for="text_cidade">Cidade</label>
                <input type="text" name="text_cidade" id="text_cidade" placeholder="Cidade" class="form-control">
            </div>

            <div class="my-3">
                <label for="text_telefone">Telefone</label>
                <input type="text" name="text_telefone" id="text_telefone" placeholder="Telefone" class="form-control">
            </div>

            <div class="my-4">
                <button type="submit" class="btn btn-primary">Criar Conta</button>
            </div>
        </form>
       
      </div>
    </div>
</div>