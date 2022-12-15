
function modele(){

    $.ajax({
        url: '/edit',
        type: "get",
        success : function(data) {
            for (var i = 0; i < data.length; i++) {
                $('#modele').text('Utilisateur : ' + data.nom + ' ' + data.libelle + '-' + data.quantite);

            }

        },
        error : function(data){
            sweetToast('Une erreur c\'est produite. Veuillez recommancer')
        }
    })
}




