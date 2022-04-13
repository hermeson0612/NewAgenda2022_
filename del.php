<?php
include_once('config/conexao.php');
if(isset($_GET['idDel'])){
    $id = $_GET['idDel'];
    //echo sid;
    $delete = "DELETE FROM tbContato WHERE idContato=:id";
    try{
        $resultDel=$conect->prepare($delete);
        $resultDel->bindParam(':id',$id,PDO::PARAM_INT);
        $resultDel->execute();
        //RETORNO DINÂMICO A PÁGINA DE RELATÓRIO
        $contar = $resultDel->rowCount();
        if($contar>0){
            header("Location: relatorio.php");
        }
    }catch(PDOException $erro){
        echo "<strong>ERRO DE DELETE: </strong>"
            .$e->getMessage();
    }
}

