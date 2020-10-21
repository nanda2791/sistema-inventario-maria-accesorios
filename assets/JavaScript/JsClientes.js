$(document).ready(function() {
    var base_url = $("#base_url").val();
    $(document).on('click', '.btn-borrar', function() {


        Swal.fire({
            title: 'Esta seguro de eliminar?',
            text: "El cliente se eliminara!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo eliminara!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {

                var id = $(this).val();

                $.ajax({
                    url: base_url + 'Mantenimiento/Clientes/borrar/' + id,
                    type: 'POST',
                    success: function(resp) {

                        window.location.href = base_url + resp;
                    }
                })


            }
        })


    });

});