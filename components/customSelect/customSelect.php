<?php 
function customSelect($customProp = "",$value=""){
    return '<div class="containerCustomSelect">
    <label for="tipoLocal">Tipo Local</label>
    <input '.$customProp.' value="'.$value.'" type="text" readonly id="tipoLocal" name="tipoLocal" />
    <div class="mainSelection" id="mainSelection">
      <div class="arrow"></div>
      <div id="alimentos" class="firstCategory selection">
        <span class="firstOption">Alimentos</span>
        <div class="overlayDiv">
          <span class="selectOptions" id="frutas">Frutas</span>
          <span class="selectOptions" id="verduras">Verduras</span>
          <span class="selectOptions" id="Granos">Granos</span>
        </div>
      </div>
      <div class="firstCategory selection">
        <span class="firstOption">Ropa y Textiles</span>
        <div class="overlayDiv">
          <span class="selectOptions" id="hombre">Para Hombre</span>
          <span class="selectOptions" id="mujer">Para Mujer</span>
          <span class="selectOptions" id="niños">Para Niños</span>
          <span class="selectOptions" id="mixto">Mixto</span>
        </div>
      </div>
  
      <div class="firstCategory selection">
        <span class="firstOption">Deportes</span>
        <div class="overlayDiv">
          <span class="selectOptions" id="futbol">Futbol</span>
          <span class="selectOptions" id="baloncesot">Balonceso</span>
          <span class="selectOptions" id="voleibol">Voleibol</span>
        </div>
      </div>
    </div>
    <script src="..\components\customSelect\customSelect.js"></script>
  </div>
  ';
} ?>