<?php

include 'includes/_funciones.php';

//Variable para saber si estas en la pantalla de login y quitar headers y footers
$loginBack = "1";

$recovery = "";
if(isset($_GET['recovery'])){$recovery = $_GET['recovery'];}
//Redirecciona al dashboard si ya se inicio session
if ($_SESSION['id'] > 0) {
    header("Location: ".base_url."dashboard");
}

require_once 'includes/_header.php';
//SI se detecta el Get de Recovery aparece otra pantalla de recuperación

?>

<div class="back-login" id="appLogin">
  <div class="container login">
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 nopadding">
        <div class="row">
          <div class="col-sm-12">
            <div class="graypart" :class="{cargando : isLoading}">
              <div class="logo-login" title="<?= $carpetaProyecto?>">
                <div class="flashmsg">
                  <div class="logindisabled" v-show="loginDisabled">
                    <div class="texto">
                      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                      <div class="h5"></div>
                      Su cuenta ha sido suspendida. <br />
                      Contacte a su administrador.
                    </div>
                  </div>
                  <div class="loginfailed" v-show="loginFailed">
                    <div class="texto">
                      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                      <div class="h5"></div>
                      Su datos son incorrectos. <br />
                      Intentelo nuevamente.
                    </div>
                  </div>
                  <div class="loginsent" v-show="loginSent">
                    <div class="texto">
                      <i class="fa fa-check-circle" aria-hidden="true"></i>
                      <div class="h5"></div>
                      ¡Listo! Se ha enviado un email con sus nuevos accesos al sistema.
                    </div>
                  </div>
                  <div class="loginrecovery" v-show="loginRecovery">
                    <div class="texto">
                      <i class="fa fa-check-circle" aria-hidden="true"></i>
                      <div class="h5"></div>
                      Su contraseña ha sido reestablecida, ya puede ingresar al sistema.
                    </div>
                  </div>
                </div>
                <img src="<?=base_url;?>img/logo.svg" alt="Login" />
              </div>
              <div class="h30"></div>

              <div class="loginfields" v-if="componentView===0">
                <form>
                  Nueva Contraseña:<br />
                  <input id="recov1" name="new_pass" v-model="recovery.newPassword" type="password"
                    @keyup.enter="doRecovery" @keyup="validaIguales()" :class="{error: isNotSame}" />
                  <br />Repetir Contraseña:<br />
                  <input id="recov2" name="new_pass_rep" v-model="recovery.confirmPassword" @keyup="validaIguales()"
                    @keyup.enter="doRecovery" :class="{error: isNotSame}" type="password" />
                  <input id="hash" name="hash" type="hidden" value="<?=$recovery;?>" />
                  <div class="lostpass"><a id="regresar-login" href="javascript:;" @click="componentView=1"> <strong>
                        < Regresar al login</strong></a></div>
                  <div class="botonRecovery" @click="doRecovery">CAMBIAR CONTRASEÑA</div>
                </form>
              </div>
              <div class="loginfields" v-if="componentView===1">
                <input id="usuario" type="email" name="usuario" autofocus="autofocus" placeholder="Usuario"
                  v-model="login.usuario" @keyup.enter="doLogin()" />
                <input id="password" type="password" name="password" placeholder="Contraseña" v-model="login.password"
                  @keyup.enter="doLogin()" />
                <div class="botonIngresar" @click="doLogin()">INGRESAR AL SISTEMA</div>
                <div class="h20"></div>
                <div class="lostpass">¿No recuerdas tu contraseña? <a href="javascript:;" id="getRecover"><strong
                      @click="componentView = 2 ">Clic aquí</strong></a></div>
              </div>
              <div class="recoverfields" v-if="componentView===2">
                <div class="logintitle">Restablecer la contraseña.</div>Escriba el email que este vinculado
                a su cuenta de acceso.<br /><br />
                <input type="email" name="email" id="recuperaMail" placeholder="Email de acceso"
                  v-model="forgot.forgotEmail" @keyup.enter="doForgot()" /><br />
                <div id="mandaEmail" class="botonIngresar" @click.enter="doForgot()">RECUPERAR</div>
                <div class="h20"></div>
                <div class="lostpass"><a id="regresar" href="javascript:;" @click="componentView=1"> <strong>
                      < Regresar al login</strong></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script type="text/javascript" src="<?= base_url ?>js/login.js"></script>
</body>

</html>