<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"> 
    <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <title>CRUD GENERATOR</title>
        <link rel="stylesheet" href="<?php echo $this->uri.'/Lib/vendor/twbs/bootstrap/dist/css/bootstrap.css'; ?>">
    <script src="<?php echo $this->uri.'/Lib/vendor/twbs/boostrap/css/bootstrap.css'; ?>"></script>
    
    </head> 
    <body>       
       <div class="container" style="padding-top:60px;">
               <?php echo $this->Session->flash(); ?>
        	<?php echo $content_for_layout; ?>
        </div>
         
    </body> 
   
</html>
