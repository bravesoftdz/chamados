<?php    
require_once './includes/conexao.php';
include_once './includes/cabecalho.php';
include_once './includes/dashboard.php';
$mensagem = '';

    if (isset($_GET['id'])) {
        $id = mysqli_escape_string($con, $_GET['id']);
        if (isset($_GET['enviou'])) {
            $descricao = mysqli_escape_string($con, $_GET['descricao']);

            $sql = "UPDATE nivel SET descricao = '$descricao' WHERE id = $id";

            $resultado = mysqli_query($con, $sql);

            if ($resultado) {
                $mensagem = '<div class="row"><p class="alert alert-success">Nível alterado com sucesso! 
                                <a class="btn btn-default" href="niveis.php">Voltar</a>
                            </p></div>';
            } else {
                $mensagem = '<p class="alert alert-danger">Não foi possível efetuar a alteração. <br>Por favor, tente novamente...</p>';
            }
        }
    
    $sql = 'SELECT * FROM nivel WHERE id = '.$id;
    
    $resultado = mysqli_query($con, $sql);
    $nivel = mysqli_fetch_assoc($resultado);
    }
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Nível (Editar)</h1>
    <?php
    echo $mensagem;
    ?>
    
    <div class="form-horizontal" style="margin: 15px 15px 15px 15px">
        <form method="get" action="nivel_edit.php">
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao" value="<?= $nivel['descricao']; ?>" placeholder="Descrição">
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="<?= $_GET['id']; ?>">
            <input type="hidden" name="enviou" id="enviou" value="true">
            <div class="row">
                <a class="btn btn-default" href="niveis.php">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>
<?php
include_once './includes/rodape.php';