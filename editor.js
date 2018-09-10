function commande(nom, argument) {
    if (typeof argument === 'undefined') {
        argument = '';
    }
    switch(nom){
        case "createLink":
            argument = prompt("Quelle est l'adresse du lien ?");
            break;
        case "insertImage":
            argument = prompt("Quelle est l'adresse de l'image ?");
            break;
    }
    if(document.queryCommandValue(nom)){

        let elm = document.getElementById("button_" + nom +  "")

        if(elm.className === 'active'){
            elm.className = 'inactive';
        } else {
            elm.className = 'active';
        }
    }
    ;

    document.execCommand(nom, false, argument);

}