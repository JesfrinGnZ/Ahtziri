<?php

  include("conexion.php");
  $codCuestionarioJugado=$_POST['codigoCuestionario'];
  $nickname=$_POST['nickname'];

  $resultadoNick = $conexion->prepare("SELECT Cuestionario_Id FROM CUESTIONARIO_REALIZADO WHERE CodigoGenerado=?");
  if (!$resultadoNick->execute(array($codCuestionarioJugado))) {
      #error en la consulta anterior
      echo"Algo ha ido mal en la consulta a la base de datos";
  }

  $row_cnt = $resultadoNick->rowCount();
  if ($row_cnt==0) {
    echo "<div class=\"row\">
            <div class=\"col-md-5\">
              <div class=\"card\">
                <div align=\"center\" class=\"card-header\">
                  <img src=\"Imagenes/Error.png\" style=\"width:60%; height:60%;\">
                </div>
              </div>
            </div>
          </div>
          <div class=\"row\">
            <div class=\"col-md-5\">
                <div class=\"card card-stats card-danger\">
                  <div class=\"card-body \">
                    <div class=\"row\">
                      <div class=\"col-4\">
                        <div class=\"icon-big text-center\">
                          <i class=\"la la-frown-o\"></i>
                        </div>
                      </div>
                      <div class=\"col-7 d-flex align-items-center\">
                        <div class=\"numbers\">
                          <h4 class=\"card-title\">¡El cuestionario ingresado no existe!</h4>
                          <p class=\"card-category\">Intenta ingresar el código de nuevo.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>";
  }else{
      while ($resultado = $resultadoNick->fetch(PDO::FETCH_BOTH)) {
        $idCuestionarioGuardado = $resultado[Cuestionario_Id];
      }

      $resultadoActivo = $conexion->prepare("SELECT * FROM CUESTIONARIO WHERE idCuestionario=? AND Activo=?");
      $activo=1;
      if (!$resultadoActivo->execute(array($idCuestionarioGuardado,$activo))) {
        #error en la consulta anterior
        echo"Algo ha ido mal en la consulta a la base de datos";
      }
      $row_cnt2 = $resultadoActivo->rowCount();
      if ($row_cnt2>0) {
          $resultadoJug = $conexion->prepare("SELECT * FROM JUGADOR INNER JOIN CUESTIONARIO_REALIZADO WHERE
          JUGADOR.Nickname=? AND CUESTIONARIO_REALIZADO.CodigoGenerado=?");
          if (!$resultadoJug->execute(array($nickname,$codCuestionarioJugado))) {
            #error en la consulta anterior
            echo"Algo ha ido mal en la consulta a la base de datos";
          }
          $row_cnt3 = $resultadoJug->rowCount();
          if ($row_cnt3==0) {
            $insertarJug = $conexion->prepare("INSERT INTO JUGADOR (Nickname, codigoCuestionario) VALUES (?,?)");
            if (!$insertarJug->execute(array($nickname,$codCuestionarioJugado))) {
              #error en la consulta anterior
              echo"Algo ha ido mal en la consulta a la base de datos";
            }
            echo "<div class=\"row\">
                    <div class=\"col-md-6\">
                      <div class=\"card\">
                        <div align=\"center\" class=\"card-header\">
                          <img src=\"Imagenes/EsperaunMomento.png\" style=\"width:100%; height:100%;\">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=\"row\">
                    <div class=\"col-md-6\">
                        <div class=\"card card-stats card-success\">
                          <div class=\"card-body \">
                            <div class=\"row\">
                              <div class=\"col-4\">
                                <div class=\"icon-big text-center\">
                                  <i class=\"la la-smile-o\"></i>
                                </div>
                              </div>
                              <div class=\"col-7 d-flex align-items-center\">
                                <div class=\"numbers\">
                                  <h4 class=\"card-title\">¿Listo para empezar? Usuario: $nickname</h4>
                                  <p class=\"card-category\">Espera un momento</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>";

          }else{
            echo "<div class=\"row\">
                    <div class=\"col-md-5\">
                      <div class=\"card\">
                        <div align=\"center\" class=\"card-header\">
                          <img src=\"Imagenes/warning.gif\" style=\"width:60%; height:60%;\">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class=\"row\">
                    <div class=\"col-md-5\">
                        <div class=\"card card-stats card-warning\">
                          <div class=\"card-body \">
                            <div class=\"row\">
                              <div class=\"col-4\">
                                <div class=\"icon-big text-center\">
                                  <i class=\"la la-frown-o\"></i>
                                </div>
                              </div>
                              <div class=\"col-7 d-flex align-items-center\">
                                <div class=\"numbers\">
                                  <h4 class=\"card-title\">¡El nickname que has elegido está en uso!</h4>
                                  <p class=\"card-category\">Ingresa de nuevo</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>";
          }

      }else{
        header('Location: cuestionarioNoDisponible.php');
      }
  }

 ?>
