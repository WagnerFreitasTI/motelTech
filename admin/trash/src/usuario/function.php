<?php 

function validaUsuario($usuario, $senha,$pdo) {
  
  $login_usuario = addslashes($usuario);
  $senha_usuario = addslashes($senha);
  
  
  $sql = "SELECT *  FROM usuario where login =? and senha=?  ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$login_usuario,$senha_usuario]);
  $resultado =  $stmt->fetch(PDO::FETCH_ASSOC);

  
  if (empty($resultado) ) {
    return false;
  } else {   
    $_SESSION['usuarioLogado'] = 1; 
	$_SESSION['usuarioLogin'] = $resultado['login'];
	$_SESSION['usuarioSenha'] = $resultado['senha'];
	 return true;
  }
  
     return false;
   
  }
  
function getUsuario($pdo){
	
	$login_usuario = !isset($_SESSION['usuarioLogin']) ? "vazio":$_SESSION['usuarioLogin'];
    $senha_usuario =  !isset($_SESSION['usuarioSenha']) ? "vazio":$_SESSION['usuarioSenha'];
  
	$sql = "SELECT *  FROM usuario WHERE login = ?  AND senha = ?  LIMIT 1 ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$login_usuario,$senha_usuario]);
	return $stmt->fetch(PDO::FETCH_ASSOC);
   
}
function getUsuarioByID($pdo,$id){
	
	
  
	$sql = "SELECT *  FROM usuario WHERE id = ?   LIMIT 1 ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
	return $stmt->fetch(PDO::FETCH_ASSOC);
   
}
function newLoginLog($pdo,$id){
	
	$sql = "INSERT INTO usuario_login_log (id_usuario) VALUES (?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$id]); 
				
}  
function protegePagina($pdo) {
	
   
  
  	$login_usuario = !isset($_SESSION['usuarioLogin']) ? "vazio":$_SESSION['usuarioLogin'];
    $senha_usuario =  !isset($_SESSION['usuarioSenha']) ? "vazio":$_SESSION['usuarioSenha'];
  
  
  $sql = "SELECT *  FROM usuario where login =? and senha=?  ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$login_usuario,$senha_usuario]);
  $resultado =  $stmt->fetch(PDO::FETCH_ASSOC);

  
  if (!$resultado) {
	  expulsaVisitante();
  }
  
    return true;
  }
  
function expulsaVisitante() {
  
  unset($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
  $_SESSION['usuarioLogado'] = 0;
  
  
  header("Location: index");
  return;
}
