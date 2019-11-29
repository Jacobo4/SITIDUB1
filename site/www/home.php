
<!DOCTYPE html>
<?php
  session_start();
  if(!isset($_SESSION['username']) & !isset($_SESSION['rol'])  ){
    header('Location: index.php');
  }else{
    $user = $_SESSION['username'];
    $rol = $_SESSION['rol'];
  }

 ?>
<html>

<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="title" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/vendors.css">


</head>

<body>
  <nav class="ctn-normal">
    <div class="row">
      <div class="col-6">
        <h1>SITIDOB</h1>
      </div>
      <div class="col-6">
        <div class="icon-menu"></div>
      </div>
      <div class="col-12">
        <div class="menu-container">
          <div class="menu-content">
            <ul>
              <li><a href="">Home</a></li>
              <li><a href="">Pagina 2</a></li>
              <li><a href="">Pagina 3</a></li>
              <li><button id="acountbtn">Acount</button></li>
            </ul>
          </div>

          <div class="account-container">
            <img src="assets/images/melosCaramelos.jpeg" alt="">
            <h4><?php echo $user ?></h4>
            <h4><?php echo $rol ?></h4>
            <button id="editUser" class="btn" type="button" name="button">Editar datos</button>
            <button id="logOut" class="btn" type="button" name="button">Cerrar sesion</button>

          </div>
        </div>

      </div>


    </div>
  </nav>
  <div class="container-fluid">

    <section id="home">


      <div class="container">


        <div class="ctn-normal options-container">
          <?php if( $rol == 'Coordinador'){?>
          <div class="options-content">
            <button id="newStudent" class="alerta" type="button" name="button">New Student</button>

          </div>
          <?php } ?>
          <div class="search-container">
            <span class="icon-search"></span>
            <input id="searchAll"class="input-form " type="text" name="searchAll" value="" placeholder="">
          </div>
        </div>


        <div class="table-container ctn-normal">
          <table class="">
            <thead>
              <tr>
                <th>#</th>
                <th>ID number</th>
                <th>Means of ID</th>
                <th>Names</th>
                <th>Surnames</th>
                <th>Options</th>
                
              </tr>
            </thead>
            <tbody id="showStudents">
            </tbody>
          </table>
        </div>

      </div>

    </section>
  </div>

    <!-- NOTE: MODAL EDITAR DATOS USER  -->
    <div class="modal" id="modalEditUser">

      <div class="modal-container ">

        <div class="modal-tittle ctn-normal">
          <h1>Settings</h1>
        </div>

        <div class="modal-body  ctn-normal text-center">

          <div class="loading">
            <img src="assets/images/loader.gif" alt="loading..">
          </div>


          <form id="editUsername" action="index.html" method="post">

            <div class="row justify-content-center">

              <div class="col-12">
                <h2>Username</h2>
              </div>
              <div class="col-12 col-lg-6">
                <label for="newUsername">New Username</label>
                <input id="newUsername" class="input-form" type="text" name="newUsername" placeholder="Avoid Alvaro Uribe as username">
              </div>

            </div>
            <button class="btn-submitModal" type="submit" name="button">Send</button>


          </form>

          <form id="editPassword" action="index.html" method="post">
            <div class="row justify-content-center">
              <div class="col-12">
                <h2>Password</h2>
              </div>

              <div class="col-12 col-lg-6">
                <label for="newPassword">New Password</label>
                <input id="newPassword" class="input-form" type="password" name="newPassword">
              </div>
              <div class="col-12 col-lg-6">
                <label for="oldPassword">Old Password .___.</label>
                <input id="oldPassword" class="input-form" type="password" name="oldPassword">
              </div>
              <div class="col-12 col-lg-6">
                <label for="secretWord">Secret Word ;)</label>
                <input id="secretWord" class="input-form" type="password" name="secretWord">
              </div>

            </div>
            <button class="btn-submitModal" type="submit" name="button">Send</button>
            <button class="btn-cancel" type="button" name="button">Cancel</button>

          </form>
        </div>
      </div>

    </div>

    <!-- NOTE: MODAL ELIMINAR  -->
    <div class="modal" id="modalDelete">

      <div class="modal-container ">

        <div class="modal-body  ctn-normal text-center">

          <div class="loading">
            <img src="assets/images/loader.gif" alt="loading..">
          </div>

          <h2>Are you sure?</h2>
          <form id="delete" action="index.html" method="post">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-6">
                <label for="idDelete">Please digit again the student's id</label>
                <input id="idDelete" class="input-form" type="text" name="idDelete">
              </div>
            </div>
            <button class="btn-submitModal" type="submit" name="button">Delete</button>
            <button class="btn-cancel" type="button" name="button">Cancel</button>
          </form>

        </div>
      </div>

    </div>

    <!-- NOTE: MODAL NUEVA MATRICULA  -->
    <div class="modal" id="modalMatricula">

      <div class="modal-container ">
        <div class="modal-tittle ctn-normal">
          <h1>Nombre del estudiante</h1>
        </div>

        <div class="modal-body  ctn-normal text-center">

          <div class="loading">
            <img src="assets/images/loader.gif" alt="loading..">
          </div>

          <form id="matricula" action="index.html" method="post">

            <div class="row">
              <div class="col-12">
                <h2>Datos matrícula</h2>
              </div>

              <div class="col-12 col-sm-6">
                <label for="numMatri">Número de matrícula</label>
                <input id="numMatri" class="input-form" type="text" name="numMatri" placeholder="ej: ASAD-01">
              </div>
              <div class="col-12 col-sm-6">
                <label for="fechaInialMatri">Fecha inicial</label>
                <input id="fechaInialMatri" class="input-form" type="date" name="fechaInicialMatri">
              </div>
            </div>

            <button class="btn-submitModal" type="submit" name="button">Next</button>
            <button class="btn-cancel" type="button" name="button">Cancel</button>
          </form>


        </div>
      </div>

    </div>

    <!-- NOTE: MODAL NUEVO ESTUDIANTE -->
    <div class="modal" id="modalNewStudent">

      <div class="modal-container">

        <div class="modal-tittle ctn-normal">
          <h1>New student</h1>
        </div>

        <div class="modal-body ctn-normal">

          <div class="loading">
            <img src="assets/images/loader.gif" alt="loading..">
          </div>

          <form id="estudiante" action="index.html" method="post">

            <div class="row">


              <div class="col-12">
                <h2 id="tittle-person"></h2>
              </div>


              <div class="col-12 col-sm-6">
                <label for="nombresEstu">Names</label>
                <input id="nombresEstu" class="input-form" type="text" name="nombres" placeholder="Alvaro Paraco">
              </div>
              <div class="col-12 col-sm-6">
                <label for="apellidosEstu">Surnames</label>
                <input id="apellidosEstu" class="input-form" type="text" name="apellidos" placeholder="Uribe Velez">
              </div>
              <div class="col-12 col-sm-6">
                <label for="numIdentEstu">Identification number</label>
                <input id="numIdentEstu" class="input-form numIdent" type="identification" name="numIdent" placeholder="1001065497">
                <select id="tipoIdentEstu" class="select-form tipoIdent" type="select" name="tipoIdent">
                  <option value="TI">TI</option>
                  <option value="CC">CC</option>
                  <option value="CE">CE</option>
                </select>
              </div>

              <div class="col-12 col-sm-6">
                <label for="lugarExpe">Expedition place</label>
                <select id="lugarExpe" class="input-form citys "type="select" name="lugarExpe" placeholder="Birthplace">

                </select>
              </div>

              <div class="col-12 col-sm-6">
                <label for="fechaNaci">Birthdate</label>
                <input id="fechaNaci" class="input-form" type="date" name="fechaNaci">
              </div>

              <div class="col-12 col-sm-6">
                <label for="lugarNaci">Birthplace</label>
                <select id="lugarNaci" class="input-form citys "type="select" name="lugarNaci" placeholder="Birthplace">

                </select>
              </div>

              <div class="col-12 col-sm-6">
                <label for="direccionEstu">Address</label>
                <input id="direccionEstu" class="input-form" type="text" name="direccion" placeholder="Calle A">
              </div>

              <div class="col-12 col-sm-6">
                <label for="emailEstu">Email</label>
                <input id="emailEstu" class="input-form" type="emailCustom" name="email" placeholder="ej: jamespapasito@gmail.com">
              </div>

              <div class="col-12 col-sm-6">
                <label for="telResiEstu">Home's phone number</label>
                <input id="telResiEstu" class="input-form" type="text" name="telResi" placeholder="3462116">
              </div>


              <div class="col-12 mt-5">
                <h2 class="">Clinic info</h2>
              </div>

              <div class="col-12 col-sm-6">
                <label for="eps">EPS</label>
                <input id="eps" class="input-form " type="text" name="eps" placeholder="EPS">
              </div>

              <div class="col-6 col-sm-3 col-lg-2">
                <label for="rh">Blood type</label>
                <select id="rh" class="input-form bloodTypes" type="select" name="rh">
                </select>

              </div>

              <div class="col-6 col-sm-3 col-lg-2">
                <label for="estrato">Income Class</label>
                <select id="estrato" class="select-form " type="select" name="estrato">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
              </div>



            </div>
            <button class="btn-submitModal" type="submit" name="button">Save</button>
            <button class="btn-cancel" type="button" name="button">Cancel</button>
          </form>


        </div>


      </div>
    </div>

    <!-- NOTE: MODAL NUEVO RESPONSABLE -->
    <div class="modal" id="modalNewRelative">

      <div class="modal-container">

        <div class="modal-tittle ctn-normal">
          <h1>New relative</h1>
        </div>

        <div class="modal-body ctn-normal">

          <div class="loading">
            <img src="assets/images/loader.gif" alt="loading..">
          </div>

          <form id="responsable" action="index.html" method="post">

            <div class="row">


              <div class="col-12">
                <h2 id="tittle-person"></h2>
              </div>


              <div class="col-12 col-sm-6">
                <label for="nombresRes">Names</label>
                <input id="nombresRes" class="input-form" type="text" name="nombres" placeholder="Alvaro Paraco">
              </div>
              <div class="col-12 col-sm-6">
                <label for="apellidosRes">Surnames</label>
                <input id="apellidosRes" class="input-form" type="text" name="apellidos" placeholder="Uribe Velez">
              </div>
              <div class="col-12 col-sm-6">
                <label for="numIdentRes">Identification number</label>
                <input id="numIdentRes" class="input-form numIdent" type="identification" name="numIdent" placeholder="1001065497">
                <select id="tipoIdentRes" class="select-form tipoIdent" type="select" name="tipoIdent">
                  <option value="TI">TI</option>
                  <option value="CC">CC</option>
                  <option value="CE">CE</option>
                </select>
              </div>

              <div class="col-12 col-sm-6">
                <label for="direccionRes">Address</label>
                <input id="direccionRes" class="input-form" type="text" name="direccion" placeholder="Calle A">
              </div>

              <div class="col-12 col-sm-6">
                <label for="emailRes">Email</label>
                <input id="emailRes" class="input-form" type="emailCustom" name="email" placeholder="ej: jamespapasito@gmail.com">
              </div>

              <div class="col-12 col-sm-6">
                <label for="telResiRes">Home's phone number</label>
                <input id="telResiRes" class="input-form" type="text" name="telResi" placeholder="3462116">
              </div>

              <div class="col-12 col-sm-6">
                <label for="celular">cell phone number</label>
                <input id="celular" class="input-form" type="text" name="celular" placeholder="3132029021">
              </div>

              <div class="col-12 col-sm-6">
                <label for="ocupacion">Employment</label>
                <input id="ocupacion" class="input-form" type="text" name="ocupacion" placeholder="Zapatero">
              </div>

              <div class="col-12 col-sm-6">
                <label for="profesion">Profession</label>
                <input id="profesion" class="input-form" type="text" name="profesion" placeholder="Ingeniero Industrial">
              </div>

              <div class="col-12 col-sm-6">
                <label for="parentesco">Parentesco</label>
                <input id="parentesco" class="input-form" type="text" name="parentesco" placeholder="Papá">
              </div>

            </div>
            <button class="btn-submitModal" type="submit" name="button">Save</button>
            <button class="btn-cancel" type="button" name="button">Cancel</button>
          </form>


        </div>


      </div>
    </div>


    <!-- NOTE: MODAL PARA MOSTRAR Y EDITAR -->
    <div class="modal" id="modalEditShow">

      <div class="modal-container ">

        <div class="modal-tittle ctn-normal">
          <h1 id="personName">Student's name</h1>
          <div class="showOptions">
            <button id="btn-editStudent" class="btn" type="button" name="button">Edit student's info</button>
            <button id="addRelative" type="button" name="button">Add relative</button>
          </div>
        </div>

        <div class="modal-body  ctn-normal">

          <div class="loading">
            <img src="assets/images/loader.gif" alt="loading..">
          </div>


          <form class="edit" id="editStudent" action="index.html" method="post">

            <div class="row">


              <div class="col-12">
                <h2 id="tittle-person"></h2>
              </div>


              <div class="col-12 col-sm-6">
                <label for="editNombresEstu">Names</label>
                <input id="editNombresEstu" class="input-form" type="text" name="nombres" placeholder="Alvaro Paraco">
              </div>
              <div class="col-12 col-sm-6">
                <label for="editApellidosEstu">Last names</label>
                <input id="editApellidosEstu" class="input-form" type="text" name="apellidos" placeholder="Uribe Velez">
              </div>
              <div class="col-12 col-sm-6">
                <label for="editNumIdentEstu">Identification number</label>
                <input id="editNumIdentEstu" class="input-form numIdent" type="identification" name="numIdent" placeholder="1001065497">
                <select id="editTipoIdentEstu" class="select-form tipoIdent" type="select" name="tipoIdent">
                  <option value="TI">TI</option>
                  <option value="CC">CC</option>
                  <option value="CE">CE</option>
                </select>
              </div>

              <div class="col-12 col-sm-6">
                <label for="editLugarExpe">Expedition place</label>
                <input id="editLugarExpe" class="input-form" type="text" name="lugarExpe" placeholder="Lugar de expedición">
              </div>

              <div class="col-12 col-sm-6">
                <label for="editFechaNaci">Birthdate</label>
                <input id="editFechaNaci" class="input-form" type="date" name="fechaNaci">
              </div>

              <div class="col-12 col-sm-6">
                <label for="editLugarNaci">Birthplace</label>
                <select id="editLugarNaci" class="input-form citys "type="select" name="lugarNaci" placeholder="Birthplace">

                </select>
              </div>

              <div class="col-12 col-sm-6">
                <label for="editDireccionEstu">Address</label>
                <input id="editDireccionEstu" class="input-form" type="text" name="direccion" placeholder="Calle A">
              </div>

              <div class="col-12 col-sm-6">
                <label for="editEmailEstu">Email</label>
                <input id="editEmailEstu" class="input-form" type="emailCustom" name="email" placeholder="ej: jamespapasito@gmail.com">
              </div>

              <div class="col-12 col-sm-6">
                <label for="editTelResiEstu">Home's phone number</label>
                <input id="editTelResiEstu" class="input-form" type="text" name="telResi" placeholder="3462116">
              </div>


              <div class="col-12 mt-5">
                <h2 class="">Clinic info</h2>
              </div>

              <div class="col-12 col-sm-6">
                <label for="editEps">EPS</label>
                <input id="editEps" class="input-form " type="text" name="eps" placeholder="EPS">
              </div>

              <div class="col-6 col-sm-3 col-lg-2 ">
                <label for="editRh">Blood type</label>
                <select id="editRh" class="input-form bloodTypes" type="select" name="rh">
                </select>

              </div>

              <div class="col-6 col-sm-3 col-lg-2 ">
                <label for="editEstrato">Income Class</label>
                <select id="editEstrato" class="select-form " type="select" name="estrato">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
              </div>



            </div>
            <button class="btn-submitModal" type="submit" name="button">Save</button>

          </form>



          <button class="btn-cancel" type="button" name="button">Cancel</button>
        </div>
      </div>

    </div>




    <div class="alert-container">
      <div class="alert-content">
      </div>
    </div>

    <script src="assets/js/vendors.js"></script>
    <script src="assets/js/app.js"></script>
  </body>

  </html>
