<div class="registerLocalForm registerForm">
    <h2>Registrar Local</h2>
    <p id="errorL">&nbsp</p>
    <form action="">
        <h3>Datos Basicos</h3>
        <div>
            <?php echo customInput("Nombre", "nombrelocal", "text"); ?>
            <?php echo customInput("Cedula Propietario", "cedulapropietario", "number"); ?>

            <?php echo customInput("Direccion", "direccion", "text"); ?>
            <div class="teExtrañoTailwind">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" required>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>
            <?php include "..\components\customSelect\customSelect.html" ?>
            <?php echo customInput("Imagen url", "imgUrl", "text"); ?>
        </div>
        <button type="button" onclick="registerLocal()">Enviar</button>
    </form>
    <script src="..\lib\admin\registerLocal.js"></script>
</div>