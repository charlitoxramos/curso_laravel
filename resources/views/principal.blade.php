@extends('template.template')

@section('nombre_tabla')
<h2>Proyectos</h2>
@endsection

@section('contenido')
<div class="card shadow">
  <div class="card-body">
    <table id="mitabla" class="display" style="width:100%">
    <thead>
            <tr>
                <th>Id</th>
                <th>Nombre del Proyecto</th>
                <th>Fuente de Fondos</th>
                <th>Monto Planificado</th>
                <th>Monto Patrocinado</th>
                <th>Monto Fondos Propios</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<div class="modal fade" id="modal-crear-proyecto"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
  <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Crear Proyecto</h4>
          <button type="button" class="cerrar_modal close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form name="crear-proyecto-form" id="crear-proyecto-form" action="" method="post">
          <div class="modal-body">       
              <div class="row">
                  <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <label for='nombre_proyecto'>Nombre del Proyecto</label>
                        <input id="accion" name="accion" type="hidden" value="crear">
                        <input id="id_proyecto" name="id_proyecto" type="hidden" value="">
                        <input id="nombre_proyecto" name="nombre_proyecto" type="text" class="form-control" placeholder="Nombre del Proyecto" maxlength='500' require>
                        <div id="err_nombre_proyecto"></div>
                    </div>
                  </div>                    
              </div>
              <div class="row">
                  <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <label for='fuente_fondos'>Fuente de Fondos</label>
                        <input id="fuente_fondos" name="fuente_fondos" type="text" class="form-control" placeholder="Fuente de Fondos" maxlength='500' require>
                        <div id="err_fuente_fondos"></div>
                    </div>
                  </div>                    
              </div>
              <div class="row">
                  <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <label for='monto_planificado'>Monto Planificado</label>
                        <input id="monto_planificado" name="monto_planificado" type="text" class="form-control" placeholder="0.00" value="0.00" required>
                        <div id="err_monto_planificado"></div>
                    </div>
                  </div>                    
              </div>
              <div class="row">
                  <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <label for='monto_patrocinado'>Monto Patrocinado</label>
                        <input id="monto_patrocinado" name="monto_patrocinado" type="text" class="form-control" placeholder="0.00" value="0.00" required>
                        <div id="err_monto_patrocinado"></div>
                    </div>
                  </div>                    
              </div>
              <div class="row">
                  <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <label for='monto_fondos_propios'>Monto Fondos Propios</label>
                        <input id="monto_fondos_propios" name="monto_fondos_propios" type="text" class="form-control" placeholder="0.00" value="0.00" required>
                        <div id="err_monto_fondos_propios"></div>
                    </div>
                  </div>                    
              </div>
              <div class="row">
                  <div class="col-sm-12">
                      <div id="formulario_proyecto_err"></div>
                  </div>
              </div>
          </div>
          <div class="modal-footer justify-content-between">
          <button type="button" class="cerrar_modal btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" id="boton-guardar-proyecto" name="boton-guardar-proyecto" class="btn btn-primary">Guardar</button>
          </div>
      </form>
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal --> 
<script type="application/javascript">
$(document).ready(function () {

  var validationMessages = {
      rules: {
          nombre_proyecto: {
              required: true,
          },
          fuente_fondos: {
              required: true,
              // email: "Ingrese un email valido"
          },
          monto_planificado: {
              required: true,
              number: true,
              valorMinimo: 0.00,
          },
          monto_patrocinado: {
              required: true,
              number: true,
              valorMinimo: 0.00,
          },
          monto_fondos_propios: {
              required: true,
              number: true,
              valorMinimo: 0.00,
          },
      },
      messages: {
          nombre_proyecto: 
            {
              required:"Por favor digite el nombre del Proyecto",
            },
          fuente_fondos: 
            {
              required:"Por favor ingrese el nombre de la Fuente de Fondos",
            },
          monto_planificado: 
            {
              required:"Por favor ingrese el Monto Planificado",
              number: "Debe digitar solamente números",
              valorMinimo : "El Monto Planificado debe ser cero o un valor superior",
            },
          monto_patrocinado: 
            {
              required:"Por favor ingrese el Monto Patrocinado",
              number: "Debe digitar solamente números",
              valorMinimo : "El Monto Patrocinado debe ser cero o un valor superior",
            },
          monto_fondos_propios: 
            {
              required:"Por favor ingrese el Monto de los Fondos Propios",
              number: "Debe digitar solamente números",
              valorMinimo : "El Monto del Fondo Propio debe ser cero o un valor superior",
            },
      },
      errorClass: 'text-danger small',
      errorPlacement: function (error, element) {
          $('#err_' + element.attr("name")).empty();
          $('#err_' + element.attr("name")).html('');
          $('#err_' + element.attr("name")).append(error);
      }
  };

  jQuery.validator.addMethod('valorMinimo', function (value, el, param) {
        //value = value.replace("$ ", ""); 
        return value >= param;
  });


    $('#mitabla').DataTable({
      language: {
        url: "js/lang/Spanish.json",        
      },
      dom: "<'row'<'col-12 buscar-dt'l>>" +
              "<'row'<'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 buscar-dt'B><'col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 buscar-dt'f>>" +
              "<'row'<'col-12'tr>>" +
              "<'row'<'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6'i><'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6'p>>",
      order: [1, "desc"],//La columna 1 define el orden en el que aparecen los elementos
      buttons: [
        {
          name: "botonCrear",
          text: '<i class="bi bi-plus-circle-fill mr-2"></i>Crear Proyecto',
          className: 'crear-proyecto btn btn-success btn-sm',
          titleAttr: 'Crear',
          
          action: function ( e, dt, node, config ) {
              $("#modal-crear-proyecto").modal("show");
          }
        }
      ],  
    });

    $(".cerrar_modal").click(function(){
      $("#modal-crear-proyecto").modal('toggle'); 
    });

    $('#boton-guardar-proyecto').on('click', () => {

      var accion = "";
                        
      if($("#accion").val()=="")
      {
          $("#accion").val("crear");
          accion = 'crear';
      }
      else 
      {
          accion = $("#accion").val();
      }
      
      $("#crear-proyecto-form").validate(validationMessages)
      if ($("#crear-proyecto-form").valid()) {

        //mostrar un mensaje y cerrar el modal 
        var Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                              });
                              
                              if(accion=='crear')
                              {
                                  Toast.fire({
                                      icon: 'success',
                                      title: '¡El registro se guardo con éxito!'
                                  })

                                  $('#modal-crear-proyecto').modal('toggle');

                                  //actualiza datatable() y lo regresa al inicio
                                  //$('#mitabla').DataTable().ajax.reload();

                                  
                              }
                              else if(accion=='editar')
                              {
                                  Toast.fire({
                                      icon: 'success',
                                      title: '¡El registro se ha editado con éxito!'
                                  })

                                  $('#modal-crear-proyecto').modal('toggle');

                                  //actualizar datatable() en la pagina en la que me encuentro
                                  //$('#mitabla').DataTable().ajax.reload(null,false);

                              }

      }
    })


    //cada vez que muestre el modal lo limpiara y le colocara el titulo
    $('#modal-crear-proyecto').on('show.bs.modal', function (event) {        
        var button  = $(event.relatedTarget); // Boton que abrio el modal
        var modal       = $(this);
        //titulo del modal
        var titulo = button.data('titulo');
        var accion = button.data('accion');  
        
        if ( ( titulo == undefined ) && ( accion == undefined ) )
        {
            titulo = "Crear Proyecto";
            accion = "crear";            
        }

        modal.find('.modal-title').text(titulo);
        
        if(accion == "crear")
        {
            $("#modal-crear-proyecto").find("input,textproducto,select").val("");
            
            $('#accion').val('crear'); 

        }
    });

});
</script>
@endsection