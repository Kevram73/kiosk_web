

var achatTable;
$('#boutique').on('change',function ( ) {
    $('#choix').val(null)
        $('#jr').val(null);
        $('#depenses').val(null);
        $('#moi').val(null);
        $('#annee').val(null);
    $('#achatTable').DataTable().destroy()
    });


$('#choix').on('change',function ( ) {
    if ($('#choix').val()=="mois"){
        $('#jr').hide();
        $('#depense').show();
        $('#depenses').val(null);
        $('#moi').show();
        $('#mois').empty()
        $('#mois').append('<option value=""></option>',
            '<option value="1">Janvier</option>',
            '<option value="2">Fevrier</option>',
            '<option value="3">Mars</option>',
            '<option value="4">Avril</option>',
            '<option value="5">Mai</option>',
            '<option value="6">Juin</option>',
            '<option value="7">Juillet</option>',
            '<option value="8">Aout</option>',
            '<option value="9">Septembre</option>',
            '<option value="10">Octobre</option>',
            '<option value="11">Novembre</option>',
            '<option value="12">Decembre</option>');
        $('#an').show()

        $.ajax({
            url: '/adminanneevente-'+ $('#boutique').val(),
            type: "get",
            success: function (data) {

                $('#annee').empty()
                $('#annee').append('<option value=""></option>')
                for (var i = 0; i < data.length; i++) {
                    $('#annee').append('<option value="' + data[i].annee + '">' + data[i].annee + '</option>')
                }

            },
            error: function (data) {
                console.log("erreur")
            },
        })
        $('#mois').on('change',function ( ) {
            $.ajax({
                url: '/admintotalmois-'+ $('#mois').val()+"-"+ $('#annee').val()+"-"+ $('#boutique').val(),
                type: "get",
                success: function (data) {
                    $('#depenses').val(data);
                },
                error: function (data) {
                    console.log("erreur")
                },
            })
            $('#achatTable').DataTable().destroy()
            $(function () {
                achatTable=$('#achatTable').DataTable({
                    processing: true,
                    serverSide: true,
                    'paging': true,
                    'lengthChange': true,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true,
                    language: {
                        "sProcessing": "Traitement en cours...",
                        "sSearch": "Rechercher&nbsp;:",
                        "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                        "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                        "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                        "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        "sInfoPostFix": "",
                        "sLoadingRecords": "Chargement en cours...",
                        "sPrint": "Imprimer",
                        "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                        "oPaginate": {
                            "sFirst": "Premier",
                            "sPrevious": "Pr&eacute;c&eacute;dent",
                            "sNext": "Suivant",
                            "sLast": "Dernier"
                        },
                        "oAria": {
                            "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                        },
                        "select": {
                            "rows": {
                                _: "%d lignes séléctionnées",
                                0: "Aucune ligne séléctionnée",
                                1: "1 ligne séléctionnée"
                            }
                        }
                    },

                    ajax: '/adminrecupererventemois-'+ $('#mois').val()+"-"+ $('#annee').val()+"-"+ $('#boutique').val(),
                    "columns": [
                        {data:"vente",name : 'vente'},
                        {data:"totaux",name : 'totaux'},
                        {data: "action", name : 'action' , orderable: false, searchable: false}

                    ]

                });
            });
        });
    }
    else {
        if ($('#choix').val()==""){
            $('#jr').hide();
            $('#moi').hide();
            $('#depense').hide();
            $('#an').hide();
            $('#achatTable').DataTable().destroy()
        }
        if ($('#choix').val()=="jour"){
            $('#jr').val(null);
            $('#jr').show();
            $('#depense').show();
            $('#depenses').val(null);
            $('#moi').hide();
            $('#an').hide();
            $.ajax({
                url: '/adminrecupererdatvente-'+ $('#boutique').val(),
                type: "get",
                success: function (data) {

                    $('#jour').empty()
                    $('#jour').append('<option value=""></option>')

                    var tab=data;
                    for (var i = 0; i < tab["fran"].length; i++) {
                        $('#jour').append('<option value="'+tab["id"][i]+'">'+tab["fran"][i]+'</option>')
                    }

                },
                error: function (data) {
                    console.log("erreur")
                },
            })
            $('#jour').on('change',function ( ) {
                $.ajax({
                    url: '/admintotaljour-'+ $('#jour').val()+"-"+ $('#boutique').val(),
                    type: "get",
                    success: function (data) {
                        $('#depenses').val(data);
                    },
                    error: function (data) {
                        console.log("erreur")
                    },
                })
                $('#achatTable').DataTable().destroy()
                $(function () {
                    achatTable=$('#achatTable').DataTable({
                        processing: true,
                        serverSide: true,
                        'paging': true,
                        'lengthChange': true,
                        'searching': true,
                        'ordering': true,
                        'info': true,
                        'autoWidth': true,
                        language: {
                            "sProcessing": "Traitement en cours...",
                            "sSearch": "Rechercher&nbsp;:",
                            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                            "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                            "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                            "sInfoPostFix": "",
                            "sLoadingRecords": "Chargement en cours...",
                            "sPrint": "Imprimer",
                            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                            "oPaginate": {
                                "sFirst": "Premier",
                                "sPrevious": "Pr&eacute;c&eacute;dent",
                                "sNext": "Suivant",
                                "sLast": "Dernier"
                            },
                            "oAria": {
                                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                            },
                            "select": {
                                "rows": {
                                    _: "%d lignes séléctionnées",
                                    0: "Aucune ligne séléctionnée",
                                    1: "1 ligne séléctionnée"
                                }
                            }
                        },


                        ajax: '/adminrecupererventedate-'+ $('#jour').val()+"-"+ $('#boutique').val(),
                        "columns": [
                            {data:"vente",name : 'vente'},
                            {data:"totaux",name : 'totaux'},
                            {data: "action", name : 'action' , orderable: false, searchable: false}

                        ]

                    });
                });
            })
        }
        
        if ($('#choix').val()=="an"){
            $('#jr').hide();
            $('#depense').show();
            $('#depenses').val(null);
            $('#moi').hide();
            $('#an').show();
            $.ajax({
                url: '/adminanneevente-'+ $('#boutique').val(),
                type: "get",
                success: function (data) {

                    $('#annee').empty()
                    $('#annee').append('<option value=""></option>')
                    for (var i = 0; i < data.length; i++) {
                        $('#annee').append('<option value="' + data[i].annee + '">' + data[i].annee + '</option>')
                    }

                },
                error: function (data) {
                    console.log("erreur")
                },
            })

            $('#annee').on('change',function ( ) {
                $('#depenses').val(null);
                $.ajax({
                    url: '/admintotalannee-'+ $('#annee').val()+"-"+ $('#boutique').val(),
                    type: "get",
                    success: function (data) {
                        $('#depenses').val(data);
                    },
                    error: function (data) {
                        console.log("erreur")
                    },
                })
                $('#achatTable').DataTable().destroy()
                $(function () {
                    achatTable=$('#achatTable').DataTable({
                        processing: true,
                        serverSide: true,
                        'paging': true,
                        'lengthChange': true,
                        'searching': true,
                        'ordering': true,
                        'info': true,
                        'autoWidth': true,
                        language: {
                            "sProcessing": "Traitement en cours...",
                            "sSearch": "Rechercher&nbsp;:",
                            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                            "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                            "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                            "sInfoPostFix": "",
                            "sLoadingRecords": "Chargement en cours...",
                            "sPrint": "Imprimer",
                            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                            "oPaginate": {
                                "sFirst": "Premier",
                                "sPrevious": "Pr&eacute;c&eacute;dent",
                                "sNext": "Suivant",
                                "sLast": "Dernier"
                            },
                            "oAria": {
                                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                            },
                            "select": {
                                "rows": {
                                    _: "%d lignes séléctionnées",
                                    0: "Aucune ligne séléctionnée",
                                    1: "1 ligne séléctionnée"
                                }
                            }
                        },


                        ajax: '/adminrecupererventeannee-'+ $('#annee').val()+"-"+ $('#boutique').val(),
                        "columns": [
                            {data:"vente",name : 'vente'},
                            {data:"totaux",name : 'totaux'},
                            {data: "action", name : 'action' , orderable: false, searchable: false}

                        ]

                    });
                });
            })
        }
    }
})

function show(id){

    $.ajax({
        url: '/showvente-'+id,
        type: "get",
        success : function(data) {
            window.location='/detailvente-'+id

        },
        error : function(data){
            window.location='/detailvente2-'+id
        }
    })
}









