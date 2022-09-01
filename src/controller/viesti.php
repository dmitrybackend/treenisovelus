<?php 
function saadaViesti($viestiTyyppi,$lisaParam){
    $viesti = [];
    
    switch($viestiTyyppi){
        case "treeni_luotu":
            $viesti['title'] = "Treeni luotu.";
            $viesti['viesti'] = "Treeni luotu.";    
            break;
        case "treeni_upd":
            $viesti['title'] = "Treeni muokattu.";
            $viesti['viesti'] = "Treeni muokattu.";    
            break;
        default:
            $viesti['title'] = "Huppista! Sivua ei löytynyt.";
            $viesti['viesti'] = "Valitettavasti pyytämääsi sivua ei ole. Ole hyvä ja tarkista sivun osoite.";
    }

    
    return $viesti;

}

?>