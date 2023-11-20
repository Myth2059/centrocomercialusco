<?php include "../components/customInput/CustomInput.php"; 
session_start();
?>
<?php include "../components/customSelect/customSelect.php"; ?>
<?php
    echo "<script>var cedula =" . $_SESSION['usuario_cedula'] . " ;</script>"
    
    ?> <?php include "..\lib\local\getLocal.php";
    $result;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = getLocal($id);
        echo "<script>var id =" . $id . " ;</script>";
    } else {
        echo "No se proporcionó un valor para 'id'.";
    }


    ?> <div class="localContainer">
    <h2>Informacion</h2>
    <div>
        <img src="" alt="">
    </div>
    <div class="localDataProp">
        <?php
        if ($result[0]['usuarios_cedula'] == $_SESSION['usuario_cedula'] && $_SESSION['usuario_rol'] == "Propietario" || $_SESSION['usuario_rol'] == "Administrador") {
            echo ' <div class="updateSection" onclick="enableDisableEditU()">
            <i id="updateProp" class="gg-pen"></i>
        </div>';
        };

        ?>
        <h3>Datos del Propietario</h3>
        <p>&nbsp</p>
        <form class="formPropietario" action="">
            <?php echo customInput("Nombre", "nombre", "text", "disabled", isset($result) ? $result[0]['nombre'] : "") ?>
            <?php echo customInput("Apellido", "apellido", "text", "disabled", isset($result) ? $result[0]['apellido'] : "") ?>
            <?php echo customInput("Telefono", "telefono", "text", "disabled", isset($result) ? $result[0]['telefono'] : "") ?>
        </form>
        <button id="buttonU" onclick="updateU()">Actualizar</button>
    </div>
    <hr>
    <div class="localDataProp">
        <?php if ($result[0]['usuarios_cedula'] == $_SESSION['usuario_cedula'] && $_SESSION['usuario_rol'] == "Propietario" || $_SESSION['usuario_rol'] == "Administrador") {
            echo '<div class="updateSection" onclick="enableDisableEditL()">
            <i id="updateLocal" class="gg-pen"></i>
        </div>';
        }; ?>
        
        <h3>Datos del local</h3>
        <p>&nbsp</p>

        <form class="formLocal" action="">
            <?php echo customInput("Nombre", "nombreLocal", "text", "disabled", isset($result) ? $result[0]['nombreLocal'] : ""); ?>
            <?php echo customInput("Ubicacion", "ubicacion", "text", "disabled", isset($result) ? $result[0]['ubicacion'] : "") ?>
            <div class="estadoContainer">
                <label for="">Estado</label>
                <select disabled name="estado" id="estado" required>
                    <option <?php echo  $result[0]['estado'] == "Activo" ? "selected" : ""   ?> value="Activo">Activo</option>
                    <option <?php echo  $result[0]['estado'] == "Inactivo" ? "selected" : ""   ?> value="Inactivo">Inactivo</option>
                    <option <?php echo  $result[0]['estado'] == "Deuda" ? "selected" : ""   ?> value="Deuda">En Deuda</option>
                    <option <?php echo  $result[0]['estado'] == "Desalojo" ? "selected" : ""   ?> value="Desalojo">Desalojo</option>
                </select>
            </div>
            <?php echo customSelect("disabled", isset($result) ? $result[0]['categoria'] . " > " . $result[0]['subcategoria'] : "") ?>

        </form>
        <button onclick="updateL()" id="buttonL">Actualizar</button>

    </div>
    <script src="..\lib\local\local.js"></script>
    </div>