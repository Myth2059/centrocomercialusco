<div class="registerUserForm registerForm">
    <h2>Registrar Usuario</h2>
    <p id="errorP">&nbsp</p>
    <form id="registerUserForm">
        <h3>Datos Basicos:</h3>
        <div>
            <?php
            echo customInput("Cedula", "cedula", "number");
            echo customInput("Nombre", "nombre", "text");
            echo customInput("Apellido", "apellido", "text");
            echo customInput("Tel/Cel", "telefono", "number");
            ?>
        </div>
        <hr>
        <h3>Datos de Acceso:</h3>
        <div>
            <?php echo customInput("Usuario", "usuario", "text");
            echo customInput("Contraseña", "password", "password");
            ?>
            <div class="teExtrañoTailwind">
                <label for="rol">Rol</label>
                <select name="rol" id="rol" required>
                    <option value="Guardia">Guardia</option>
                    <option value="Propietario">Propietario</option>
                    <option value="Admin">Administrador</option>
                </select>
            </div>
                
        </div>
        <button type="button" onclick="registerUser()">Enviar</button>
    </form>
    <script src="..\lib\admin\registerUser.js"></script>
</div>