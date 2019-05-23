<?php

class Contas extends Conexao
{
    // Método para listar Contas
    public function listAccounts()
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM contas ORDER BY id ASC";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }
    }

    // Método para listar histórico
    public function listHistoric($id)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM historico WHERE id_conta = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id_conta", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }
    }

    // Método para pegar informações de cada conta
    public function getInfo($id)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM contas WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }
    }

    // Método para fazer Login
    public function setLogged($agencia, $conta, $senha)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM contas WHERE agencia = :agencia AND conta = :conta AND senha = :senha";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":agencia", $agencia);
        $sql->bindValue(":conta", $conta);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            $_SESSION['login'] = $sql['id'];

            header("Location: ../index.php?login_success");
            exit;
        } else {
            header("Location: ../login.php?not_login");
        }
    }

    // Método para fazer logout
    public function logout()
    {
        unset($_SESSION['login']);
    }
}
