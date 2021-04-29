$(document).ready( function () {
    $('.table').DataTable(
        {
            "language": {
                "decimal":        ",",
                "emptyTable":     "Table vide",
                "info":           "Afficher _START_ à _END_ de _TOTAL_ entrées",
                "infoEmpty":      "Afficher 0 à 0 de 0 entrées",
                "infoFiltered":   "(Afficher _MAX_ entrées totales)",
                "infoPostFix":    "",
                "thousands":      ".",
                "lengthMenu":     "Afficher _MENU_ valeurs",
                "loadingRecords": "Chargement...",
                "processing":     "En cours...",
                "search":         "Rechercher:",
                "zeroRecords":    "Aucune correspondance",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            },
            responsive: true,
        }
    );
});
