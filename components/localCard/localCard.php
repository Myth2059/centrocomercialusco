

<?php

function cardContainer($id,$title,$ubicacion,$tel,$categoria,$subCategoria,$imgUrl) {
    $mostrarFooter = isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] == "Administrador";
  
    $html = '<div id="'.$id.'" class="cardContainer">
                <div class="titleCard"> <span>'.$title.'</span></div>
                <div onclick="goToLocal('.$id.')" class="imgCard">
                    <img src="'.$imgUrl.'" alt="'.$title.'">
                    <div class="moreCard">
                        <span>Conoce</span>
                    </div>
                </div>
                <div class="infCard">
                    <span>Local: '.$ubicacion.'</span>
                    <span>Tel: '.$tel.'</span>
                    <span>'.$categoria.', '.$subCategoria.'</span>
                </div>';

    if ($mostrarFooter) {
        $html .= '<div class="footerCard">
                    <hr>
                    <span onclick="deleteLocal('.$id.')"><i class="gg-trash"></i></span>
                  </div>';
    }

    $html .= '</div>';

    return $html;
}

?>
<div onclick="goToLocal()">

</div>