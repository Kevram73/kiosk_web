$('#donne').on('value change',function ( ) {
    $('#restant').val($('#total').val()-$('#donne').val());
    if ( $('#restant').val()>0) {
        $('#te').text('Restant');
        $('#Sdonne').text( $('#donne').val());
        $('#Srestant').text( $('#restant').val(),'fcfa');
        $('#reste').val($('#restant').val());
    }
    if ( $('#restant').val()<0) {
        $('#reste').val($('#restant').val());
        $('#te').text('Monnaie');
        $('#restant').val(   $('#restant').val()*-1);
        $('#Sdonne').text( $('#donne').val());
        $('#Srestant').text( '0 fcfa');
    }
    if($('#restant').val() == 0){
        $('#reste').val('0 fcfa');
        $('#te').text('Restant');
        $('#restant').val($('#restant').val()*-1);
        $('#Sdonne').text($('#donne').val());
        $('#Srestant').text( '0 fcfa');
    }
})

$('#valider').on('click',function ( ) {
    if($('#typeVente').val() == 1 || $('#typeVente').val() == 3 || $('#typeVente').val() == 4){
        if ( $('#restant').val()>0) {
            event.preventDefault();
            Swal.fire('Montant insufisant',
                            'Le montant du reglement est inférieur au montant de la vente',
                            'error');
        }
    }
})

