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
    $(document).on("click", ".btn-check-cliente", function() {

        cliente = $(this).val();
        infocliente = cliente.split("*");
        $("#id_clientes").val(infocliente[0]);
        $("#idcliente").val(infocliente[2]);
        $("#modal-clientes").modal("hide");
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

    $(document).on("change", " #adelanto, #descuento , .precio_unitario, .cantidad", function() {
        totalGeneral();


    });
    $(document).on("change", "#adelanto, #descuento , #estado_venta, .precio_unitario, .cantidad, .total", function() {
        saldoVenta();


    });
    $(document).on("change", "#adelanto, #descuento , .precio_unitario, .cantidad, .total", function() {
        saldoEstado();


    });
    $(document).on("change", "#adelanto, #descuento , .precio_unitario, .cantidad", function() {
        ventaTotal();


    });
    $(document).on("click", ".btn-remove-producto", function() {

        $(this).closest('tr').closest('tbody').closest('table').attr('id');
        $(this).closest("tr").remove();
        totalGeneral();
        ventaTotal();



    });
});

function agregarProducto(producto) {


    if (producto != '') {
        infoproducto = producto.split("*");

        html = "<tr>";
        html += "<td><input type ='hidden' readonly class='id_productos' name = 'id_productos[]' value = '" + infoproducto[0] + "'><input type='text' readonly class='codigo form-control' name= 'codigo[]' value ='" + infoproducto[1] + "'></td>";
        html += "<td><input type = 'text'  readonly class='nombre form-control' name = 'nombre[]' value='" + infoproducto[2] + "' ></td>";
        html += "<td><input type = 'text'  readonly class='marca form-control' name = 'marca[]' value='" + infoproducto[6] + "' ></td>";
        html += "<td><input type = 'number' step = '0.01' value = '0' class='precio_unitario form-control' min = '0' name = 'precio_unitario[]' ></td>";
        html += "<td><input type = 'number' step = '1' value = '0'  class='cantidad form-control' min = '0' name = 'cantidad[]' ></td>";
        html += "<td><input type = 'number' readonly  step = '0.01'  value = '0'  class='total form-control' min = '0' name = 'total[]' ></td>";
        html += "<td><input type = 'number'  readonly class='marca form-control' step = '0.01' name = 'Precio_promedio[]' value='" + infoproducto[7] + "' ></td>";
        html += "<td><input type = 'text' maxlength='100'  class='observaciones form-control' min = '0' name = 'observaciones[]' ></td>";
        html += "<td><button type='button' class='btn btn-danger btn-remove-producto' title = 'Eliminar fila!'><span class='fa fa-remove'></span></button></td>";
        html += "</tr>";
        $("#tbventas tbody").append(html);
        totalGeneral();
        ventaTotal();
        saldoVenta();
        saldoEstado()




    } else {
        alert("seleccione un producto");
    }
}

function totalGeneral() {

    $('#tbventas tbody tr').each(function() {

        descuento = $('#descuento').val();
        precio_unitario = Number($(this).find("td:eq(3)").children('input').val());
        cantidad = Number($(this).find("td:eq(4)").children('input').val());
        total_unitario = (precio_unitario * cantidad);
        porcentaje = total_unitario * (descuento / 100);
        total = total_unitario - porcentaje;
        $(this).find("td:eq(5)").children('input').val(Number(total).toFixed(2));

    });

}

function saldoVenta() {
    sumaSaldoVenta = 0;
    $('#tbventas tbody tr').each(function() {
        adelanto = $('#adelanto').val();
        total = Number($(this).find("td:eq(5)").children('input').val());
        sumaSaldoVenta = sumaSaldoVenta + total;
        saldo = sumaSaldoVenta - adelanto;
        if (adelanto == '') {
            total = Number($(this).find("td:eq(5)").children('input').val());
            sumaSaldoVenta = total;
            $("input[name=saldo]").val(sumaSaldoVenta.toFixed(2));
        } else {
            $("input[name=saldo]").val(saldo.toFixed(2));

        }



    });
}

function saldoEstado() {
    sumaSaldoVenta = 0;
    $('#tbventas tbody tr').each(function() {
        adelanto = $('#adelanto').val();
        estado_venta = $('#estado_venta').val();
        total = Number($(this).find("td:eq(5)").children('input').val());
        sumaSaldoVenta = sumaSaldoVenta + total;
        saldo_pagar = sumaSaldoVenta - adelanto;
        if (estado_venta == 'Cancelado') {
            saldo = 0;
            $("input[name=saldo]").val(saldo.toFixed(2));
        } else {
            $("input[name=saldo]").val(saldo_pagar.toFixed(2));

        }



    });
}

function ventaTotal() {
    sumaTotalVenta = 0;
    $('#tbventas tbody tr').each(function() {
        total = Number($(this).find("td:eq(5)").children('input').val());
        sumaTotalVenta = sumaTotalVenta + total;
        $("input[name=total_venta]").val(sumaTotalVenta.toFixed(2));


    });


}