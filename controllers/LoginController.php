<?php  
class LoginController extends Controller {
	private $pageTpl = '/views/login.tpl.php';
	public function __construct() {
		$this->model = new IndexModel();
		$this->view = new View();
	}

    public function index() { 
       if($_POST['login']=='admin'&&$_POST['password']=='123')
         {
         setcookie('name1','admin',time()+3600);
         header('Location: /');
 //        echo('<meta http-equiv="refresh" content="0; url=/">');
         } else
       if(isset($_POST['login'])&&isset($_POST['password']))
         echo('<center>НЕВЕРНЫЙ ПАРОЛЬ');
      $this->view->render($this->pageTpl,'');
      }
 
  public function out() {
                         setcookie("name1","",time()-3600,"/");
                         unset($_COOKIE['name1']); header('Location: /');} 


}