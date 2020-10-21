$(document).ready(function() {
    $('#tablaProductos').DataTable({
        responsive: "true",
        "language": {
            'lengthMenu': "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registro",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior",

            },
            "sProcesing": "Procesando...",
        }

    });


    $(document).on("click", ".btn-check-empleado", function() {

        empleado = $(this).val();
        infocliente = empleado.split("*");
        $("#id_empleados").val(infocliente[0]);
        $("#idempleado").val(infocliente[1] + ' ' + infocliente[2]);
        $("#modal-empleados").modal("hide");
    });


    $(document).on("click", ".btn-check-producto", function() {
        producto = $(this).val();
        agregarProducto(producto);
        $("#modal-productos").modal("hide");
    });
    $(document).on("change", "#precio_transportadora, .stock", function() {
        calculoUnitarioProducto();
    });
    $(document).on("change", "#iva_total, .stock, .precio_origen", function() {
        precio_unitario_iva = unitarioIva();
        $('#tbcompras tbody tr').each(function() {
            $(this).find("td:eq(6)").children('input').val(Number(precio_unitario_iva).toFixed(2));


        });


    });
    $(document).on("change", "#precio_transportadora, #iva , .precio_origen, .transporte, .iva, .stock", function() {
        precioUnitarioProducto();


    });
    $(document).on("change", "#precio_transportadora, #iva , .precio_origen, .transporte, .iva, .stock", function() {
        totalProductos();


    });
    $(document).on("change", "#precio_transportadora, #iva , .precio_origen, .transporte, .iva, .stock", function() {
        compraTotal();


    });
    $(document).on("click", ".btn-remove-producto", function() {

        $(this).closest('tr').closest('tbody').closest('table').attr('id');
        $(this).closest("tr").remove();
        precioUnitarioTransporte();
        unitarioIva();
        calculoUnitarioProducto();
        precioUnitarioProducto();
        totalProductos();
        compraTotal();

    });

});


function agregarProducto(producto) {


    if (producto != '') {
        infoproducto = producto.split("*");

        html = "<tr>";
        html += "<td><input type ='hidden' readonly class='id_productos' name = 'id_productos[]' value = '" + infoproducto[0] + "'><input type='text' readonly class='codigo form-control' name= 'codigo[]' value ='" + infoproducto[1] + "'></td>";
        html += "<td><input type = 'text'  readonly class='nombre form-control' name = 'nombre[]' value='" + infoproducto[2] + "' ></td>";
        html += "<td><input type = 'text'  readonly class='marca form-control' name = 'marca[]' value='" + infoproducto[6] + "' ></td>";
        html += "<td><input type = 'number' step = '0.01' value = '0' class='precio_origen form-control' min = '0' name = 'precio_origen[]' ></td>";
        html += "<td><input type = 'number' step = '0.01' value = '1'  class='stock form-control' min = '0' name = 'stock[]'  ></td>";
        html += "<td><input type = 'number' readonly step = '0.01' value = '0'  class='transporte form-control' min = '0' name = 'transporte[]' ></td>";
        html += "<td><input type = 'number' readonly step = '0.01' value = '0'  class='iva form-control' min = '0' name = 'iva[]' ></td>";
        html += "<td><input type = 'number' readonly  step = '0.01'  value = '0'  class='precio_unitario form-control' min = '0' name = 'precio_unitario[]' ></td>";
        html += "<td><input type = 'number' readonly  step = '0.01'  value = '0'  class='total form-control' min = '0' name = 'total[]' ></td>";
        html += "<td><input type = 'text' maxlength='100'  class='observaciones form-control' min = '0' name = 'observaciones[]' ></td>";
        html += "<td><button type='button' class='btn btn-danger btn-remove-producto' title = 'Eliminar fila!'><span class='fa fa-remove'></span></button></td>";
        html += "</tr>";
        $("#tbcompras tbody").append(html);
        precioUnitarioTransporte();
        precio_unitario_iva = unitarioIva();
        $('#tbcompras tbody tr').each(function() {
            $(this).find("td:eq(6)").children('input').val(Number(precio_unitario_iva).toFixed(2));


        });
        calculoUnitarioProducto();
        precioUnitarioProducto();
        totalProductos();
        compraTotal();

    } else {
        alert("seleccione un producto");
    }
}

function precioUnitarioTransporte() {
    sumaStock = 0;
    precio_transporte = $('#precio_transportadora').val();
    $('#tbcompras tbody tr').each(function() {
        stock = Number($(this).find("td:eq(4)").children('input').val());
        sumaStock = sumaStock + stock;
    });
    precio_unitario_transporte = precio_transporte / sumaStock;
    return precio_unitario_transporte;
}

function unitarioIva() {
    sumaStock = 0;
    iva_total = $('#iva_total').val();
    $('#tbcompras tbody tr').each(function() {
        stock = Number($(this).find("td:eq(4)").children('input').val());
        sumaStock = sumaStock + stock;
    });
    precio_unitario_iva = iva_total / sumaStock;
    return precio_unitario_iva;
}

function calculoUnitarioProducto() {
    precio_unitario = precioUnitarioTransporte();
    $('#tbcompras tbody tr').each(function() {
        $(this).find("td:eq(5)").children('input').val(Number(precio_unitario).toFixed(2));


    });
}

function precioUnitarioProducto() {

    $('#tbcompras tbody tr').each(function() {
        precio_origen = Number($(this).find("td:eq(3)").children('input').val());
        transporte = Number($(this).find("td:eq(5)").children('input').val());
        iva_total = Number($(this).find("td:eq(6)").children('input').val());
        precio_unitario = precio_origen + transporte + iva_total;
        $(this).find("td:eq(7)").children('input').val(Number(precio_unitario).toFixed(2));

    });

}

function totalProductos() {

    $('#tbcompras tbody tr').each(function() {
        stock = Number($(this).find("td:eq(4)").children('input').val());
        precio_unitario = Number($(this).find("td:eq(7)").children('input').val());
        total = precio_unitario * stock;
        $(this).find("td:eq(8)").children('input').val(Number(total).toFixed(2));


    });


}

function compraTotal() {
    sumaTotalCompra = 0;
    $('#tbcompras tbody tr').each(function() {
        total = Number($(this).find("td:eq(8)").children('input').val());
        sumaTotalCompra = sumaTotalCompra + total;


    });
    if (sumaTotalCompra == 0) {
        precio_transporte = Number($('#precio_transportadora').val());
        iva_total = Number($('#iva_total').val());
        sumaTotalCompra = precio_transporte + iva_total;
        $("input[name=total_compra]").val(sumaTotalCompra.toFixed(2));

    } else {
        $("input[name=total_compra]").val(sumaTotalCompra.toFixed(2));

    }


}