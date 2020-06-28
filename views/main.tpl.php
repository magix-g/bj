<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Задачи</title>
	<meta name="vieport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body style="text-align:center">
   			<div class="row">
   				<div class="col-md-12">
   					<h2 style="text-align:center">Задачи</h2>
   					<form method="post" id="myform"> 
   						<input type="hidden" name="taskId" id="taskId" value=""> <!--value="<?php echo $pageData['userInfo']['id']; ?>"-->
   						<fieldset>
   							<div class="form-group" >
   								<label for="name" class="col-md-4 control-label" style="text-align:center">Имя</label>
   								<div class="col-md-4" style="margin: auto">
   									<input class="form-control input-md" required="true" type="text" id="name1" name="name1"> <!--value="<?php echo $pageData['userInfo']['login']; ?>"-->
   								</div>
   							</div>

   							<div class="form-group">
   								<label for="email" class="col-md-4 control-label">Email</label>
   								<div class="col-md-4" style="margin: auto">
   									<input class="form-control input-md" required="true" type="email" id="email" name="email">
   								</div>
   							</div>

   							<div class="form-group">
   								<label for="task" class="col-md-4 control-label">Задача</label>
   								<div class="col-md-4" style="margin: auto" >
   									<input class="form-control input-md" required="true" type="text" id="task" name="task"> <!--value="<?php echo $pageData['userInfo']['login']; ?>"-->
   								</div>
    							</div>


   							<div class="form-group">
   								<div class="col-md-offset-4 col-md-8" style="margin: auto">
   									<button id="save" name="save" class="btn btn-success" value="insert!">Добавить</button>
                                                                        <button id="upd" id="upd" name="upd" style="display: none" class="btn btn-success" OnClick='document.form1.submit();' value="update!">Обновить</button>
   								</div>
   							</div>
   						</fieldset>
   					</form>
   				</div>
   			</div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive" style="margin: 0 auto; width:70%; text-align: center;">
                                        <table class="table table-bordered table-hover table-striped" style="margin: 0 auto; text-align: center;">
                                            <thead>
                                                <tr>
                                                    <!--th>ID</th-->
                                                  <form name="form_name" method="post">
                                                    <th><a href="javascript:void(0)" OnClick="document.form_name.submit();">
                                                        <input type="hidden" name="_name1" value="Name">
                                                        Имя</a></th>
                                                  </form>
                                                  <form name="form_mail" method="post">
                                                    <th><a href="javascript:void(0)" OnClick="document.form_mail.submit();">
                                                        <input type="hidden" name="_email" value="Mail">
                                                        E-mail</a></th>
                                                  </form>

                                                  <form name="form_task" method="post">
                                                    <th><a href="javascript:void(0)" OnClick="document.form_task.submit();">
                                                        <input type="hidden" name="_task" value="Task">
                                                        Задача</a></th>
                                                  </form>


                                                    <th>Статус</th>
                                                    <th <?php echo(!isset($_COOKIE['name1'])?"style='display: none'":"" ); ?>   >Изменить</th>
                                                    <th <?php echo(!isset($_COOKIE['name1'])?"style='display: none'":"" ); ?>>Удалить</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    echo('<p>'.$_POST['msg'].'</p>');
                                                    foreach ($pageData['taskList'] as $key => $value) { ?>
                                                        <tr><!-- data-ng-click="showEditForm(); getUserData(<?php echo $value['id']; ?>);"-->
                                                            <!--td><?php echo $value['ID']; ?>  </td-->
                                                            <td><?php echo $value['Name']; ?></td>
                                                            <td><?php echo $value['Mail']; ?></td>
                                                            <td><?php echo $value['Task']; ?>
                                                                <p style='font-size:13px; color:#baaddd; margin-top:0px;'><?php echo $value['Changed']; ?><p></td>
                                                            <td>
                                                            <label>
                                                                <form name='form_check<?php echo $value['ID']; ?>' method="post">
                                                                <input type="hidden" name="chId" value="<?php echo $value['ID']; ?>">
                                                                <input <?php echo(!isset($_COOKIE['name1'])?"disabled":"" ); ?>  type="checkbox" name="che" OnChange='document.form_check<?php echo $value['ID']; ?>.submit();' <?echo($value['Todo']==1?"checked":'');?>> 
                                                                                       <?echo($value['Todo']==1?"Выполнено":'');?>
                                                                </form>

                                                            </label></td>

                                                            <!--td><form method="post"> 
                                                            <button class="btn btn-success" name="del" value="<?php echo $value['ID']; ?>">УДАЛИТЬ</button></form></td-->
                                                            <td <?php echo(!isset($_COOKIE['name1'])?"style='display: none'":"" ); ?>><form name='form_upd_<?php echo $value['ID']; ?>' method="post">
                                                                     <input type="hidden" name="upd_id" value="<?php echo $value['ID']; ?>">
                                                                     <input type="hidden" name="task" value="<?php echo $value['Task']; ?>">
                                                                <a href="javascript:void(0)" OnClick='
                                                                                document.getElementById("task").value = "<?php echo $value['Task']; ?>";
                                                                                document.getElementById("name1").value = "<?php echo $value['Name']; ?>";
                                                                                document.getElementById("email").value = "<?php echo $value['Mail']; ?>"; 
                                                                                document.getElementById("taskId").value = "<?php echo $value['ID']; ?>"; 
                                                                                document.getElementById("upd").style.display="initial";  
                                                                                '>
                                                                   Изменить</a>
                                                                </form>
                                                            </td>

                                                            <td <?php echo(!isset($_COOKIE['name1'])?"style='display: none'":"" ); ?>>
                                                                <form name='form_del<?php echo $value['ID']; ?>' method="post">
                                                                     <input type="hidden" name="del" value="<?php echo $value['ID']; ?>">
                                                                <a href="javascript:void(0)" OnClick='document.form_del<?php echo $value['ID']; ?>.submit(); '>
                                                                Удалить</a>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                             <br>        <?php echo($_POST['pag']);  ?>



                 <?php if(isset($_COOKIE['name1']))
                      echo('<br><br>Привет, '. $_COOKIE['name1'].'!<br><a href="/login/out">Выход</a>');
                 else
                      echo('<br><br><a href="/login">Войти</a>');
                       
                   ?>



	<script src="/js/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js"></script>
	<script src="/js/script.js"></script>
	<script src="/js/bootstrap.min.js"></script>
        <script>
        function s()
         {
         document.getElementById("task").value = "<?php echo $value['Task']; ?>";
         document.getElementById("name1").value = "<?php echo $value['Name']; ?>";
         document.getElementById("email").value = "<?php echo $value['Mail']; ?>"; 
         document.getElementById("taskId").value = "<?php echo $value['ID']; ?>"; 
         document.getElementById("upd").style.display="initial";  
         }
       </script>


<!--a href="" id="my-link" >Linkk</a>
<script>
$('#my-link').on("click", function(){ alert('11');
  $.ajax({
    type: 'POST',
    url: 'http://test.yaltadom.su/Index/delTask',
    data: {pres: 'value'},
    success: function(e){},
    dataType: 'json'
  });
})
</script>

<input name="submit1" id="submit1" type="button" value="click!" /-->
                                                                   
</body>
</html>