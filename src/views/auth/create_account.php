<div class="container">
    <div class="row">
      <div class="col-sm-6 offset-sm-3">
        <h3 class="text-center my-5">Registro de Novo Cliente</h3>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center p-2">
                <?php if(is_array($_SESSION['error'])): ?>
                    <ul class="list-errors">
                        <?php foreach ($_SESSION['error'] as $error): ?>
                            <?php foreach ($error as $err): ?>
                                <li><?= $err ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <span><?= $_SESSION['error'] ?></span>
                <?php endif; ?>
            </div>
            <?php unset($_SESSION['error']) ?>
        <?php endif; ?>

        <?php if (isset($conta_criada) || !empty($conta_criada)): ?>
            <div class="alert alert-success text-center p-2">
                <span><?= $conta_criada ?></span>
            </div>
        <?php endif; ?>

        <form action="?a=create_account" method="post">
            <div class="my-3">
                <label for="text_email">Email</label>
                <input type="text" name="text_email" id="text_email" placeholder="Email" class="form-control">
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