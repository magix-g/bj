<?php

class IndexController extends Controller {

	private $pageTpl = '/views/main.tpl.php';
	public function __construct() {
		$this->model = new IndexModel();
		$this->view = new View();
	}

    public function index() { 
//      print_r($_POST);

        if(isset($_POST['name1'])&&isset($_POST['email'])&&isset($_POST['task'])&&isset($_POST['save']))
           {$this->addTask(); header('Location: /');}

        if(isset($_POST['del']))
           { if(isset($_COOKIE['name1'])) $this->delTask(); else $_POST['msg']='НЕТ ПОЛНОМОЧИЙ! ЗАЛОГИНЬТЕСЬ!';}

        if(isset($_POST['upd'])&&isset($_POST['task']))
           { if(isset($_COOKIE['name1'])) $this->updTask(); else $_POST['msg']='НЕТ ПОЛНОМОЧИЙ! ЗАЛОГИНЬТЕСЬ!';}

        if(isset($_POST['chId']))
           {$this->checkChange(); header('Location: /');}

        $this->pageN();
        $this->pageData['taskList'] = $this->model->getTasks();
        $this->view->render($this->pageTpl, $this->pageData);

        echo("<br><br>Страница ". ($_SESSION['PAGE_NUM']+3)/3);
      }


	public function delTask() {
		if($this->model->delTask($_POST['del'])) 
  		        $_POST['msg']='УДАЛЕНО'; 
         	else 
			$_POST['msg']='Ошибка при удалении';
        }

	public function updTask() {
		if($this->model->updTask($_POST['taskId'],$_POST['task'],$_POST['name1'],$_POST['email']))
  		    $_POST['msg']="ИЗМЕНЕНО";
         	else 
   		    $_POST['msg']="Ошибка при изменении";
        }

	public function addTask() {

	if(empty($_POST) || !isset($_POST['name1']) || !isset($_POST['email'])|| !isset($_POST['task']))
		echo("Введите все данные");
        else {
		$Name1 = trim($_POST['name1']);
		$Email = trim($_POST['email']);
		$Task = trim($_POST['task']);

               /* if($this->model->getTaskDub($Name1, $Task, $Email)) 
                return;*/

		if($this->model->addTask($Name1, $Task, $Email)) 
			$_POST['msg']="ДОБАВЛЕНО";
         	else 
			$_POST['msg']="Ошибка при обновлении";
		
  	       }
	}

      public function checkChange() {
		$this->model->checkChange($_POST['chId']);
      }

      public function pageN() {
                $_SESSION['items_per_page']=3;

                $pages_count = ceil($this->model->getCount() / $_SESSION['items_per_page']);

                for ($i = 1; $i <= $pages_count; $i++)
                $_POST['pag']=$_POST['pag'].
                "<form name='form_page".$i."' method='post' style='display: inline-block; margin-right:10px;'>
                <input type='hidden' name='page_n' value='".$i."'>
                <a href='javascript:void(0)' OnClick='document.form_page".$i.".submit();'>
                    ".$i."</a> 
                </form>";

                if (!isset($_SESSION['PAGE_NUM']))
                   $_SESSION['PAGE_NUM']=0;

                if (!isset($_SESSION['FIELD_SORT']))
                   $_SESSION['FIELD_SORT']='Name';

                if (!isset($_SESSION['FIELD_ORD']))
                   $_SESSION['FIELD_ORD']='desc';

                if($_POST['_task']||$_POST['_name1']||$_POST['_email'])
                  $_SESSION['FIELD_ORD'] = ($_SESSION['FIELD_ORD'] == 'asc')?'desc':'asc';

                if($_POST['page_n']) 
                  $_SESSION['PAGE_NUM'] = $_POST['page_n'] * $_SESSION['items_per_page'] - $_SESSION['items_per_page'];

                if($_POST['_task'])
                  $_SESSION['FIELD_SORT']='Task'; 

                if($_POST['_name1'])
                  $_SESSION['FIELD_SORT']='Name'; 

                if($_POST['_email'])
                  $_SESSION['FIELD_SORT']='Mail'; 

               }
 }
