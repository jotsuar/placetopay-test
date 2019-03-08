<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="content-type" content="text/html; utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pagos - <?php echo __($this->params->params["controller"]) ?> </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="robots" content="noindex">
  <meta name="googlebot" content="noindex">
  <link rel="icon" type="image/x-icon" href="<?php echo $this->Html->url('/') ?>img/favicon.ico" />
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->Html->url('/') ?>img/favicon.ico" />
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
  <?php 

  	echo $this->Html->css('/bootstrap/css/bootstrap.min.css');
      echo $this->Html->css('/dist/css/AdminLTE.min.css');
      echo $this->Html->css('/dist/css/skins/_all-skins.min.css');
      echo $this->Html->css('font-awesome.min.css');
      echo $this->Html->css('ionicons.min.css');
       echo $this->Html->css('sweetalert');      

    echo $this->Html->css('/plugins/Parsley/parsley');
    echo $this->Html->css('jquery.tag-editor');
  ?>
  
    <script type="text/javascript">
        
        var root        = "<?php echo Router::url("/",true); ?>"
        var controller  = "<?php echo $this->params->params["controller"]; ?>"
        var action      = "<?php echo $this->params->params["action"]; ?>"
    </script>



  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <?php echo $this->Session->flash(); ?>
	<?php echo $this->element("header")  ?>
	<?php echo  $this->element("left_column") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <!-- <h3 class="box-title">Title</h3> -->
        </div>
        <div class="box-body">
         <?php echo $this->fetch('content'); ?>
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
	echo $this->Html->script('/plugins/jQuery/jquery-2.2.3.min.js');
	echo $this->Html->script('/bootstrap/js/bootstrap.min.js');
	echo $this->Html->script('bootstrap-notify.min');
	echo $this->Html->script('/plugins/slimScroll/jquery.slimscroll.min.js');
	echo $this->Html->script('/plugins/fastclick/fastclick.js');
    echo $this->Html->script('sweetalert.min');    
	echo $this->Html->script('tinymce/tinymce.min');
  echo $this->Html->script('/dist/js/demo.js');
  echo $this->Html->script('/plugins/Parsley/parsley.min');
  echo $this->Html->script('/plugins/Parsley/i18n/es');
  echo $this->Html->script('jquery.caret.min');
  echo $this->Html->script('jquery.tag-editor.min');
  echo $this->Html->script('all');

 ?>
  <?php echo $this->fetch('SCRIPT_BOTTOM'); ?>
<script>
  $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
</script>
</body>
</html>
