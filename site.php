<?php

session_start();


echo "
<a href=code.php?s=1>Главная</a>  
<a href=code.php?s=2>О компании</a>  
<a href=code.php?s=3>Обратная связь</a> <br/><br/>";


echo '
	<form action="code.php" method="post">';
if(!isset($_SESSION['login']) OR $_SESSION['login']=='')
{	
	echo '
	 Логин: <input type="text" name="log" />
	 Пароль: <input type="password" name="pass" />
	 <input type="submit" value="Войти" name="log_in" />
	';
}
else{ echo 'Пользователь: <a href=#>'.$_SESSION['login'].'</a>';
	echo ' <input type="submit" value="Выйти" name="log_out" />';
	}
echo '</form>';
	
$article_max=56;
$n=14;
$page_max=ceil($article_max/$n);

if(isset($_POST["log"])) $log=$_POST["log"];
else $log='';
if(isset($_POST["pass"])) $pass=$_POST["pass"];
else $pass='';

if(isset($_GET["s"])) $s=$_GET["s"];
else $s=1;
if(isset($_GET["page"])) $page=$_GET["page"]*$n;
else $page=0;

$_SESSION['login']=$log;


if($s==1)
{
	for($i=1+$page; $i<=$n+$page; $i++)
	{
		echo '
		<article>
			<header>Статья №'.$i.'</header>
			<p>Lorem ipsum dolor sit erum autem.</p>
			<footer>		</footer>
		</article>
		';
		if($i==$article_max) break;
	}
	for($i=1; $i<=$page_max; $i++)
		echo '<a href=code.php?s=1&page='.($i-1).'>'.$i.'</a> ';
}
else echo 'новый раздел';