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
                <th>Acciones</th>
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
        <!--<form method="POST" action="{{ route('proyecto.crear') }}" name="crear-proyecto-form" id="crear-proyecto-form" >-->
        <form method="POST" action="#" name="crear-proyecto-form" id="crear-proyecto-form" >
          @csrf
            <div class="modal-body">
            <input id="accion" name="accion" type="hidden" value="crear">
                        <input id="id_proyecto" name="id_proyecto" type="hidden" value="">
                               
              <div class="row">
                  <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <label for='nombre_proyecto'>Nombre del Proyecto</label>
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
          <input type="button" value="Guardar" id="boton-guardar-proyecto" name="boton-guardar-proyecto" class="btn btn-primary">
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
      ajax:{
        url: "/proyecto/lista", 
        dataSrc:"",
        type: "GET",
        beforeSend: function () { 
                      
        },
        complete: function (data) { // Set our complete callback, adding the .hidden class and hiding the spinner.
          //console.log(data);     
          
          
          
        },
      },
      columns: [
        { 
          data: 'id',
          visible: false, 
        },
        { 
          data: 'nombre', 
        },
        { 
          data: 'fuente', 
        },
        { 
          data: 'planificado', 
          "render": function (data) 
          {
              var respuesta = '$'+(data).toFixed(2);
              return respuesta;
          }, 
        },
        { 
          data: 'patrocinado', 
          "render": function (data) 
          {
              var respuesta = '$'+(data).toFixed(2);
              return respuesta;
          },
        },
        { 
          data: 'propios', 
          "render": function (data) 
          {
              var respuesta = '$'+(data).toFixed(2);
              return respuesta;
          },
        },
        {       
          "orderable": false,
          "width": "10%",
          responsivePriority: 2,
          data: function ( data, type, full, meta ) {
              var respuesta = '';
              respuesta += `<button type="button" class="editar btn btn-info btn-sm mr-1" data-toggle="modal" data-target="#modal-crear-proyecto" data-titulo="Editar Proyecto" data-accion="editar" title="Editar">
                              <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="eliminar btn btn-danger btn-sm ml-1" title="Eliminar">
                              <i class="bi bi-trash"></i>
                            </button>
                            <button type="button" class="informe btn btn-warning btn-sm ml-1" title="Ver Reporte">
                              <i class="bi bi-file-earmark-medical"></i>
                            </button>
                            `;
              
              return respuesta;
          },
          "className": "align-middle text-nowrap", 
        }, 
      ],
      language: {
        url: "js/lang/Spanish.json",        
      },
      dom: "<'row'<'col-12 buscar-dt'l>>" +
              "<'row'<'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 buscar-dt'B><'col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 buscar-dt'f>>" +
              "<'row'<'col-12'tr>>" +
              "<'row'<'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6'i><'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6'p>>",
      order: [1, "asc"],//La columna 1 define el orden en el que aparecen los elementos
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

    $('#mitabla tbody').on('click', '.editar', function () {

        $('#modal-crear-proyecto').modal('show');
        
        var row = $(this).closest('tr');

        var id = $('#mitabla').DataTable().row( row ).data().id;
        var nombre = $('#mitabla').DataTable().row( row ).data().nombre;
        var fuente = $('#mitabla').DataTable().row( row ).data().fuente;
        var planificado = $('#mitabla').DataTable().row( row ).data().planificado;
        var patrocinado = $('#mitabla').DataTable().row( row ).data().patrocinado;
        var propios= $('#mitabla').DataTable().row( row ).data().propios;
        
        $('#id_proyecto').val(id);
        $('#nombre_proyecto').val(nombre);
        $('#fuente_fondos').val(fuente);
        $('#monto_planificado').val(planificado);
        $('#monto_patrocinado').val(patrocinado);
        $('#monto_fondos_propios').val(propios);
        $('#accion').val('editar');
        $('#modal-crear-proyecto').find('.modal-title').text("Editar Proyecto");      
        $('#modal-crear-proyecto').find('#boton-guardar-proyecto').val('Actualizar');
        
        
    });

    //Boton Eliminar
    $('#mitabla tbody').on('click', '.eliminar', function () {
        var infoPages = $('#mitabla').DataTable().page.info();

        var row = $(this).closest('tr');
        
        var id = $('#mitabla').DataTable().row( row ).data().id;
        
        Swal.fire({
            title: '¿Esta seguro?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Deseo Borrar el Registro',
            cancelButtonText: "No, ¡Cancelar!"
          }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                  url: '/proyecto/eliminar/',
                  data: {
                    'id': id,
                  },
                  type: 'DELETE',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function (data) {
                    if(data.Respuesta=='Ok')
                    {  
                      //actualizar datatable();
                      if ( ( infoPages.page + 1 ) == infoPages.pages )//Si esta en la ultima pagina
                      {
                          //si solo hay un registro
                          if ( infoPages.start == ( infoPages.end-1 ) )
                          {
                              //si ya no hay ningun registro
                              if(infoPages.page == 0)
                              {
                                  $('#mitabla').DataTable().ajax.reload();
                              }
                              else 
                              {
                                  //Ya que ya sabemos que va a borrar el ultimo registro, nos movemos a la pagina anterior
                                  $("#mitabla").DataTable().page(infoPages.page-1).draw('page');
                                  //y entonces actualizamos el datatable sin que cambie de pagina
                                  $('#mitabla').DataTable().ajax.reload(null,false);
                              }
                          }
                          else // si esta en la ultima pagina pero aún hay registros
                          {
                              //actualizar datatable() en la misma pagina donde esta
                              $('#mitabla').DataTable().ajax.reload(null,false);    
                          }
                      }
                      else //Si no esta en la ultima página
                      {
                          //actualizar datatable() en la misma pagina donde esta
                          $('#mitabla').DataTable().ajax.reload(null,false);
                      }      
                                                  
                      
                      Swal.fire(
                          'Borrado',
                          'El registro se ha borrado.',
                          'success'
                      )
                    }             
                  }
                });               
            }
          })
    });

    $('#mitabla tbody').on('click', '.editar', function () {

      var row = $(this).closest('tr');

      var id = $('#mitabla').DataTable().row( row ).data().id;
      var nombre = $('#mitabla').DataTable().row( row ).data().nombre;
      var fuente = $('#mitabla').DataTable().row( row ).data().fuente;
      var planificado = $('#mitabla').DataTable().row( row ).data().planificado;
      var patrocinado = $('#mitabla').DataTable().row( row ).data().patrocinado;
      var propios= $('#mitabla').DataTable().row( row ).data().propios;

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

        var url = "";
        var datos = {};
        var type = "";
        
        if(accion=="crear")
        {
          url = '/proyecto/crear';
          datos = {
            nombre: $('#nombre_proyecto').val(),
            fuente: $('#fuente_fondos').val(),
            planificado: $('#monto_planificado').val(),
            patrocinado: $('#monto_patrocinado').val(),
            propios: $('#monto_fondos_propios').val(),
          };
          type = 'POST';
        }
        else 
        {
          url = '/proyecto/editar';
          datos = {
            id: $('#id_proyecto').val(),
            nombre: $('#nombre_proyecto').val(),
            fuente: $('#fuente_fondos').val(),
            planificado: $('#monto_planificado').val(),
            patrocinado: $('#monto_patrocinado').val(),
            propios: $('#monto_fondos_propios').val(),
          };
          type = 'PUT';
        }
       

        $.ajax({
          "url": url,
          "data": datos,
          "type": type,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (data) {
            if(data.Respuesta=='Ok')
            {
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
                  $('#mitabla').DataTable().ajax.reload();

                  
              }
              else if(accion=='editar')
              {
                  Toast.fire({
                      icon: 'success',
                      title: '¡El registro se ha editado con éxito!'
                  })

                  $('#modal-crear-proyecto').modal('toggle');

                  //actualizar datatable() en la pagina en la que me encuentro
                  $('#mitabla').DataTable().ajax.reload(null,false);

              }
            }
          },
          error: function (jqXHR, status, err) {
            console.log(err);
          },
        });

                

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
            $('#modal-crear-proyecto').find('#boton-guardar-proyecto').val('Guardar');            
        }

        modal.find('.modal-title').text(titulo);
        
        if(accion == "crear")
        {
            $("#nombre_proyecto").val("");
            $("#fuente_fondos").val("");
            $("#monto_planificado").val("");
            $("#monto_patrocinado").val("");
            $("#monto_fondos_propios").val("");
            
            $('#accion').val('crear'); 

        }
    });

});
</script>
@endsection