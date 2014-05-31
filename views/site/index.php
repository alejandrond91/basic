<?php
/**
 * @var yii\web\View $this
 */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div id="barritaloca" style="display:none;position:fixed;left:0px;right:0px;bottom:0px;width:100%;min-height:40px;background: #222222;color:#dddddd;z-index: 99999;">
        <div style="width:100%;position:absolute;padding-left:20px;font-family:verdana;font-size:12px;top:30%;">
            Usamos cookies propias y de terceros para mejorar su experiencia en la navegación. Si continua navegando consideramos que acepta el uso de cookies.
            <a href="javascript:void(0);" style="padding:4px;background:#4682B4;text-decoration:none;color:#fff;" onclick="PonerCookie();"><b>OK</b></a>
            <a href="http://www.google.com.ar/intl/es-419/policies/technologies/types/" target="_blank" style="padding-left:5px;text-decoration:none;color:#ffffff;">M&aacute;s informaci&oacute;n</a>
        </div>
    </div>
        <script>
            function getCookie(c_name){
                var c_value = document.cookie;
                var c_start = c_value.indexOf(" " + c_name + "=");
                if (c_start == -1){
                    c_start = c_value.indexOf(c_name + "=");
                }
                if (c_start == -1){
                    c_value = null;
                }else{
                    c_start = c_value.indexOf("=", c_start) + 1;
                    var c_end = c_value.indexOf(";", c_start);
                    if (c_end == -1){
                        c_end = c_value.length;
                    }
                    c_value = unescape(c_value.substring(c_start,c_end));
                }
                return c_value;
            }

            function setCookie(c_name,value,exdays){
                var exdate=new Date();
                exdate.setDate(exdate.getDate() + exdays);
                var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
                document.cookie=c_name + "=" + c_value;
            }

            function getgeoip(json){
                if (json.country_code=="ES" && getCookie('aviso')!="1") {
                    document.getElementById("barritaloca").style.display="block";
                }

            }

            function PonerCookie(){
                setCookie('aviso','1',365);
                document.getElementById("barritaloca").style.display="none";
            }
        </script>
        <script type="application/javascript" src="http://www.telize.com/geoip?callback=getgeoip"></script>
    <div class="row">
      <div class="col-xs-6 col-md-3">
        <a data-toggle="modal" href="#myModal" class="thumbnail">
          <img src="http://placehold.it/350x150" alt="">
        </a>
      </div>
      <div class="col-xs-6 col-md-3">
        <a href="<?php $url = Yii::$app->getUrlManager()->getBaseUrl();
             $url = $url."/site/chart"; 
             echo $url; ?>" 
             class="thumbnail">
          <img src="http://placehold.it/350x150" alt="">
        </a>
      </div>
      <div class="col-xs-6 col-md-3">
        <a href="<?php $url = Yii::$app->getUrlManager()->getBaseUrl();
             $url = $url."/site/contactopersonal"; 
             echo $url; ?>"  class="thumbnail">
          <img src="http://placehold.it/350x150" alt="">
        </a>
      </div>
      <div class="col-xs-6 col-md-3">
        <a href="#" class="thumbnail">
          <img src="http://placehold.it/350x150" alt="">
        </a>
      </div>
    </div>
    <!-- Botón para generar pdf con los datos de los departamentos. -->
    <a href="<?php $url = Yii::$app->getUrlManager()->getBaseUrl();
             $url = $url."/site/pdf"; 
             echo $url; ?>" 
             class="btn btn-primary btn-lg" role="button">Generar pdf
    </a>
    <!-- Botón para generar excell con el nombre del trabajador y el nombre del departamento en el que trabaja cada uno. -->
    <a href="<?php $url = Yii::$app->getUrlManager()->getBaseUrl();
             $url = $url."/site/excell"; 
             echo $url; ?>" 
             class="btn btn-primary btn-lg" role="button">Generar excell
    </a>
    <!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Análisis de rendimiento del personal</h4>
        </div>
        <div class="modal-body">
          <!-- Se va a recorrer el rendimiento de cada persona que trabaja en la empresa y colocar en un progressbar. -->
          <?php
            for ($i=0; $i < count($rendimiento) ; $i++) { 
               $nota_rendimiento = $rendimiento[$i]['rendimiento_personal'] * 10;
               $nombre_personal = $rendimiento[$i]['nombre_personal'];
               $id_personal = $rendimiento[$i]['id_personal'];
               echo "
                      <button type='button' class='btn btn-default btn-xs active'> <a style='text-decoration: none;' href='".Yii::$app->getUrlManager()->getBaseUrl()."/personal/view?id=".$id_personal."'>$nombre_personal</a> </button>
                      <div class='progress progress-striped active'>
                      <div class='progress-bar' role='progressbar' aria-valuenow='$nota_rendimiento'
                           aria-valuemin='0' aria-valuemax='100' style='width: $nota_rendimiento%;'>
                        <span class='sr-only'>$nota_rendimiento completado</span>
                      </div>
                      </div>";
            }
          ?>
        </div>
        <div class="modal-footer">
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

    <!-- Grupo de botones con enlaces
    <div class="body-content">
        <div class="btn-group btn-group-justified">
          <div class="btn-group">
            <a class="btn btn-default" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/user/admin" role="button">administrar usuarios</a>
          </div>
          <div class="btn-group">
            <a class="btn btn-default" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/user/settings/profile" role="button">Mi perfil</a>
          </div>
          <div class="btn-group">
            <a class="btn btn-default" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/user/registration/register" role="button">Registrarse</a>
          </div>
        </div>
    -->
        
    <!--
        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
    -->

    </div>
</div>
