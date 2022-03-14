const $tituloPagina = document.getElementById('tituloPagina');
const $tituloCard = document.getElementById('tituloCard');
const $cuerpoCard = document.getElementById('cuerpoCard');
const $btnsMarca = document.querySelectorAll('btnMarca');
const $btnsCategoria = document.querySelectorAll('btnCategoria');
const $btnsUnidadMedida = document.querySelectorAll('btnUnidadMedida');
let $btnAgregar = document.createElement('button');
var tipo = '';

const $fragment = document.createDocumentFragment();

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function activarSideBar() {
   const $btnSBProducto = document.getElementById('btnSB' + capitalizeFirstLetter(tipo));
   $btnSBProducto.classList.remove('active');
   switch (tipo) {
      case 'producto':
         $btnSBProducto.classList.add('active');
         break;
   
      default:
         break;
   }
}

function formularioProducto() {
   // INICIO - Formulario
   if (document.getElementById('modalBody').children != 1) {
      // Obtener formulario
      const $modalBody = document.getElementById('modalBody');

      // Fila 00
      const $divFormRow0 = document.createElement('div');
      $divFormRow0.setAttribute('class', 'form-row');

         // Grupo 01 - Fila 00
         const $divFormGroup01 = document.createElement('div');
         $divFormGroup01.setAttribute('class', 'form-group col-md-12');
            const $inputCodigo = document.createElement('input');
            $inputCodigo.setAttribute('type', 'text');
            $inputCodigo.setAttribute('class', 'form-control');
            $inputCodigo.setAttribute('id', 'txtCodigo');
            $inputCodigo.setAttribute('name', 'txtCodigo');
            $inputCodigo.setAttribute('readOnly', 'true');
         $divFormGroup01.appendChild($inputCodigo);
         $divFormRow0.appendChild($divFormGroup01);
         $divFormRow0.setAttribute('hidden', 'true');
         //console.log($divFormRow0);
         // FIN Grupo 01 - Fila 00

      // FIN Fila 00

      // Fila 01
      const $divFormRow1 = document.createElement('div');
      $divFormRow1.setAttribute('class', 'form-row');

         // Grupo 01 - Fila 01
         const $divFormGroup11 = document.createElement('div');
         $divFormGroup11.setAttribute('class', 'form-group col-md-12');
            const $label11 = document.createElement('label');
            $label11.setAttribute('for', 'txtDescipcion');
            $label11.innerHTML = 'Descripción';
            const $inputDescripcion = document.createElement('input');
            $inputDescripcion.setAttribute('type', 'text');
            $inputDescripcion.setAttribute('class', 'form-control');
            $inputDescripcion.setAttribute('id', 'txtDescripcion');
            $inputDescripcion.setAttribute('name', 'txtDescripcion');
            $inputDescripcion.setAttribute('placeholder', 'Descripción del producto');
         $divFormGroup11.appendChild($label11);
         $divFormGroup11.appendChild($inputDescripcion);
         $divFormRow1.appendChild($divFormGroup11);
         //console.log($divFormRow1);
         // FIN Grupo 01 - Fila 01

      // FIN Fila 01


      // Fila 02
      const $divFormRow2 = document.createElement('div');
      $divFormRow2.setAttribute('class', 'form-row');

         // Grupo 01 - Fila 02
         const $divFormGroup21 = document.createElement('div');
         $divFormGroup21.setAttribute('class', 'form-group col-md-6');
            const $label21 = document.createElement('label');
            $label21.setAttribute('for', 'txtPrecioCompra');
            $label21.innerHTML = 'Precio de compra';
            const $inputPrecioCompra = document.createElement('input');
            $inputPrecioCompra.setAttribute('type', 'text');
            $inputPrecioCompra.setAttribute('class', 'form-control');
            $inputPrecioCompra.setAttribute('id', 'txtPrecioCompra');
            $inputPrecioCompra.setAttribute('name', 'txtPrecioCompra');
            $inputPrecioCompra.setAttribute('placeholder', '0.00');
         $divFormGroup21.appendChild($label21);
         $divFormGroup21.appendChild($inputPrecioCompra);
         $divFormRow2.appendChild($divFormGroup21);
         // FIN Grupo 01 - Fila 02

         // Grupo 02 - Fila 02
         const $divFormGroup22 = document.createElement('div');
         $divFormGroup22.setAttribute('class', 'form-group col-md-6');
            const $label22 = document.createElement('label');
            $label22.setAttribute('for', 'txtPrecioVenta');
            $label22.innerHTML = 'Precio de venta';
            const $inputPrecioVenta = document.createElement('input');
            $inputPrecioVenta.setAttribute('type', 'text');
            $inputPrecioVenta.setAttribute('class', 'form-control');
            $inputPrecioVenta.setAttribute('id', 'txtPrecioVenta');
            $inputPrecioVenta.setAttribute('name', 'txtPrecioVenta');
            $inputPrecioVenta.setAttribute('placeholder', '0.00');
         $divFormGroup22.appendChild($label22);
         $divFormGroup22.appendChild($inputPrecioVenta);
         $divFormRow2.appendChild($divFormGroup22);
         // FIN Grupo 02 - Fila 02

      // Fila 02


      // Fila 03
      const $divFormRow3 = document.createElement('div');
      $divFormRow3.setAttribute('class', 'form-row');

         // Grupo 01 - Fila 03
         const $divFormGroup31 = document.createElement('div');
         $divFormGroup31.setAttribute('class', 'form-group col-md-3');
            const $label31 = document.createElement('label');
            $label31.setAttribute('for', 'txtStock');
            $label31.innerHTML = 'Stock';
            const $inputStock = document.createElement('input');
            $inputStock.setAttribute('type', 'text');
            $inputStock.setAttribute('class', 'form-control');
            $inputStock.setAttribute('id', 'txtStock');
            $inputStock.setAttribute('name', 'txtStock');
            $inputStock.setAttribute('placeholder', '0.00');
         $divFormGroup31.appendChild($label31);
         $divFormGroup31.appendChild($inputStock);
         $divFormRow3.appendChild($divFormGroup31);
         // FIN Grupo 01 - Fila 03

         // Grupo 02 - Fila 03
         const $divFormGroup32 = document.createElement('div');
         $divFormGroup32.setAttribute('class', 'form-group col-md-3');
            const $label32 = document.createElement('label');
            $label32.setAttribute('for', 'txtStockMinimo');
            $label32.innerHTML = 'Stock mínimo';
            const $inputStockMinimo = document.createElement('input');
            $inputStockMinimo.setAttribute('type', 'text');
            $inputStockMinimo.setAttribute('class', 'form-control');
            $inputStockMinimo.setAttribute('id', 'txtStockMinimo');
            $inputStockMinimo.setAttribute('name', 'txtStockMinimo');
            $inputStockMinimo.setAttribute('placeholder', '0.00');
         $divFormGroup32.appendChild($label32);
         $divFormGroup32.appendChild($inputStockMinimo);
         $divFormRow3.appendChild($divFormGroup32);
         // FIN Grupo 02 - Fila 03

         // Grupo 03 - Fila 03
         const $divFormGroup33 = document.createElement('div');
         $divFormGroup33.setAttribute('class', 'form-group col-md-6');
            const $label33 = document.createElement('label');
            $label33.setAttribute('for', 'txtUnidadMedida');
            $label33.innerHTML = 'Unidad de medida';
            const $inputUnidadMedida = document.createElement('input');
            $inputUnidadMedida.setAttribute('type', 'text');
            $inputUnidadMedida.setAttribute('class', 'form-control');
            $inputUnidadMedida.setAttribute('id', 'txtUnidadMedida');
            $inputUnidadMedida.setAttribute('name', 'txtUnidadMedida');
            $inputUnidadMedida.setAttribute('placeholder', 'Buscar...');
            const $aUnidadMedida = document.createElement('a');
            $aUnidadMedida.setAttribute('href', '#');
            $aUnidadMedida.setAttribute('id', 'btnCambiarUnidadMedida');
            $aUnidadMedida.setAttribute('class', 'btn btn-warning');
            $aUnidadMedida.setAttribute('hidden', 'true');
            $aUnidadMedida.innerHTML = 'Cambiar';
            const $spanUnidadMedida = document.createElement('span');
            $spanUnidadMedida.setAttribute('id', 'unidadMedidaList');

         $divFormGroup33.appendChild($label33);
         $divFormGroup33.appendChild($inputUnidadMedida);
         $divFormGroup33.appendChild($aUnidadMedida);
         $divFormGroup33.appendChild($spanUnidadMedida);
         $divFormRow3.appendChild($divFormGroup33);
         // FIN Grupo 03 - Fila 03

      // Fila 03


      // Fila 04
      const $divFormRow4 = document.createElement('div');
      $divFormRow4.setAttribute('class', 'form-row');

         // Grupo 01 - Fila 04
         const $divFormGroup41 = document.createElement('div');
         $divFormGroup41.setAttribute('class', 'form-group col-md-6');
            const $label41 = document.createElement('label');
            $label41.setAttribute('for', 'txtMarca');
            $label41.innerHTML = 'Marca';
            const $inputMarca = document.createElement('input');
            $inputMarca.setAttribute('type', 'text');
            $inputMarca.setAttribute('class', 'form-control');
            $inputMarca.setAttribute('id', 'txtMarca');
            $inputMarca.setAttribute('name', 'txtMarca');
            $inputMarca.setAttribute('placeholder', 'Buscar...');
            const $aMarca = document.createElement('a');
            $aMarca.setAttribute('href', '#');
            $aMarca.setAttribute('id', 'btnCambiarMarca');
            $aMarca.setAttribute('class', 'btn btn-warning');
            $aMarca.setAttribute('hidden', 'true');
            $aMarca.innerHTML = 'Cambiar';
            const $spanMarca = document.createElement('span');
            $spanMarca.setAttribute('id', 'marcaList');

         $divFormGroup41.appendChild($label41);
         $divFormGroup41.appendChild($inputMarca);
         $divFormGroup41.appendChild($aMarca);
         $divFormGroup41.appendChild($spanMarca);
         $divFormRow4.appendChild($divFormGroup41);
         // FIN Grupo 01 - Fila 04

         // Grupo 02 - Fila 04
         const $divFormGroup42 = document.createElement('div');
         $divFormGroup42.setAttribute('class', 'form-group col-md-6');
            const $label42 = document.createElement('label');
            $label42.setAttribute('for', 'txtCategoria');
            $label42.innerHTML = 'Categoría';
            const $inputCategoria = document.createElement('input');
            $inputCategoria.setAttribute('type', 'text');
            $inputCategoria.setAttribute('class', 'form-control');
            $inputCategoria.setAttribute('id', 'txtCategoria');
            $inputCategoria.setAttribute('name', 'txtCategoria');
            $inputCategoria.setAttribute('placeholder', 'Buscar...');
            const $aCategoria = document.createElement('a');
            $aCategoria.setAttribute('href', '#');
            $aCategoria.setAttribute('id', 'btnCambiarCategoria');
            $aCategoria.setAttribute('class', 'btn btn-warning');
            $aCategoria.setAttribute('hidden', 'true');
            $aCategoria.innerHTML = 'Cambiar';
            const $spanCategoria = document.createElement('span');
            $spanCategoria.setAttribute('id', 'categoriaList');

         $divFormGroup42.appendChild($label42);
         $divFormGroup42.appendChild($inputCategoria);
         $divFormGroup42.appendChild($aCategoria);
         $divFormGroup42.appendChild($spanCategoria);
         $divFormRow4.appendChild($divFormGroup42);
         // FIN Grupo 02 - Fila 04

      // FIN Fila 04

      //console.log($modalBody);
      $modalBody.appendChild($divFormRow0);
      $modalBody.appendChild($divFormRow1);
      $modalBody.appendChild($divFormRow2);
      $modalBody.appendChild($divFormRow3);
      $modalBody.appendChild($divFormRow4);
      //console.log($modalBody);

      autocompleteSearchBars();

   } 
   // FIN - Formulario
}

function btnAgregar() {
   // Button trigger modal
   if (document.getElementById('btnAgregar') == null) {
      $btnAgregar.setAttribute('id', 'btnAgregar');
      $btnAgregar.setAttribute('type', 'button');
      $btnAgregar.setAttribute('class', 'btn btn-success mb-sm-3');
      $btnAgregar.setAttribute('data-toggle', 'modal');
      $btnAgregar.addEventListener('click', function() {
         $('#modal').modal('show');
         accion = 'registrar';
      });
      const $iconPlus = document.createElement('i');
      $iconPlus.setAttribute('class', 'fas fa-plus');
      $btnAgregar.appendChild($iconPlus);
      $btnAgregar.innerHTML = 'Agregar nuevo';
      $btnAgregar.addEventListener('click', function() {agregar();});

      $cuerpoCard.appendChild($btnAgregar);
   }
   // FIN - Button trigger modal
}

const listarTable = function listarTable(json) {
   if (document.getElementById(tipo + '_table_wrapper') != null) {
      document.getElementById(tipo + '_table_wrapper').remove();
   }
   const $table = document.createElement('table');
   $table.setAttribute('id', tipo + '_table');
   $table.setAttribute('class', 'table table-striped table-bordered dt-responsive nowrap');

   const $thead = document.createElement('thead');
   const $trTitulos = document.createElement('tr');

   let titulosColumnas = [];
   switch (tipo) {
      case 'producto':
         titulosColumnas.push(...[
            'Código',
            'Descripción',
            'Precio de compra',
            'Precio de venta',
            'Stock',
            'Stock mínimo',
            'Unidad de medida',
            'Marca',
            'Categoría',
            'Mantenimiento'
         ]);
         break;
      default:
         break;
   }

   titulosColumnas.forEach(element => {
      let $td = document.createElement('td');
      $td.innerHTML = element;
      $trTitulos.appendChild($td);
   });

   $thead.appendChild($trTitulos);

   const $tbody = document.createElement('tbody');

   json.forEach((elemento) => {
      let $tr = document.createElement('tr');
      $tr.setAttribute('id', elemento.codigo);
      for (const [clave, valor] of Object.entries(elemento)) {
         let $td = document.createElement('td');
         $td.innerHTML = valor;
         if (clave == 'unidad_medida_codigo'
            || clave == 'marca_codigo'
            || clave == 'categoria_id') {
            $td.setAttribute('value', valor);
         }
         $tr.appendChild($td);
      }

      let $td = document.createElement('td');
      let $btnEditar = document.createElement('button');
      $btnEditar.setAttribute('type', 'button');
      $btnEditar.setAttribute('name', elemento.codigo);
      $btnEditar.setAttribute('class', 'btn btn-warning editar');
      $btnEditar.setAttribute('data-toggle', 'modal');
      $btnEditar.setAttribute('data-target', '#modal');
      $btnEditar.setAttribute('onclick', 'editar(this)');
      /*$btnEditar.addEventListener('click', function() {
         editar(this);
      });*/
      let $iconEdit = document.createElement('i');
      $iconEdit.setAttribute('class', 'fas fa-edit');
      $btnEditar.appendChild($iconEdit);

      let $btnEliminar = document.createElement('button');
      $btnEliminar.setAttribute('type', 'button');
      $btnEliminar.setAttribute('id', 'eliminar'+elemento.codigo);
      $btnEliminar.setAttribute('class', 'btn btn-danger eliminar');
      $btnEliminar.setAttribute('onclick', 'eliminar(this)');
      /*$btnEliminar.addEventListener('click', function() {
         eliminar(this);
      });*/
      let $iconDelete = document.createElement('i');
      $iconDelete.setAttribute('class', 'fas fa-trash-alt');
      $btnEliminar.appendChild($iconDelete);

      $td.appendChild($btnEditar);
      $td.appendChild($btnEliminar);

      $tr.appendChild($td);

      $fragment.appendChild($tr);
   });

   $tbody.appendChild($fragment);

   const $tfoot = document.createElement('tfoot');
   const $trSubtitulos = document.createElement('tr');

   titulosColumnas.forEach(element => {
      let $td = document.createElement('td');
      $td.innerHTML = element;
      $trSubtitulos.appendChild($td);
   });

   $tfoot.appendChild($trSubtitulos);

   $table.appendChild($thead);
   $table.appendChild($tbody);
   $table.appendChild($tfoot);

   $cuerpoCard.appendChild($table);

   $('#'+tipo+'_table').DataTable({
      responsive: true,
      autoWidth: false,
      language: {
         "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
      }
   });
}

const getList = async () => {
   try {
      let response = await fetch('/primer_proyecto/'+tipo+'/index'),
         json = await response.json();
      
      if (!response.ok) {
         throw {
            status: response.status,
            statusText: response.statusText
         };
      }

      switch (tipo) {
         case 'producto':
            $tituloPagina.innerHTML = 'Productos';
            $tituloCard.innerHTML = 'Productos';
            break;
         default:
            break;
      }
      
      activarSideBar();
      formularioProducto();
      btnAgregar();

      listarTable(json);
      
   } catch (error) {
      let message = error.statusText || "Ocurrió un error";
      $cuerpoCard.innerHTML = error;
   }
} 

const $btnSBProducto = document.getElementById('btnSBProducto');
$btnSBProducto.addEventListener('click', function() {
   tipo = 'producto';
   getList();
});


const agregar = function agregar() {
   document.getElementById("modalTitulo").innerHTML = "Agregar "+tipo;
   let campos = [];
   switch (tipo) {
      case 'producto':
         campos.push(...[
            'txtCodigo',
            'txtDescripcion',
            'txtPrecioCompra',
            'txtPrecioVenta',
            'txtStock',
            'txtStockMinimo',
            'txtUnidadMedida',
            'txtMarca',
            'txtCategoria'
         ]);
         break;
      default:
         break;
   }
   campos.forEach(element => {
      document.getElementById(element).value = '';
   });
   vaciarListas();
   quitarAlerta();
   document.getElementById("btnAceptar").value = 'Registrar';
}
const editar = function editar(element) {
   document.getElementById("modalTitulo").innerHTML = "Editar "+tipo;
   $fila = document.getElementById(element.name);
   $columnas = $fila.children;
   console.log($columnas);
   switch (tipo) {
      case 'producto':
         let producto = {
            codigo: $columnas[0].innerHTML,
            descripcion: $columnas[1].innerHTML,
            precio_compra: $columnas[2].innerHTML,
            precio_venta: $columnas[3].innerHTML,
            stock: $columnas[4].innerHTML,
            stock_minimo: $columnas[5].innerHTML,
            unidad_medida: $columnas[6].getAttribute('value') + ' - ' + $columnas[6].innerHTML,
            marca: $columnas[7].getAttribute('value') + ' - ' + $columnas[7].innerHTML,
            categoria: $columnas[8].getAttribute('value') + ' - ' + $columnas[8].innerHTML
         }
         
         document.getElementById("txtCodigo").setAttribute('value', producto.codigo);
         document.getElementById("txtDescripcion").value = producto.descripcion;
         document.getElementById("txtPrecioCompra").value = producto.precio_compra;
         document.getElementById("txtPrecioVenta").value = producto.precio_venta;
         document.getElementById("txtStock").value = producto.stock;
         document.getElementById("txtStockMinimo").value = producto.stock_minimo;

         const $txtUnidadMedida = document.getElementById('txtUnidadMedida');
         $txtUnidadMedida.readOnly = true;
         $txtUnidadMedida.value = producto.unidad_medida;
         document.getElementById('btnCambiarUnidadMedida').hidden = false;

         const $txtMarca = document.getElementById('txtMarca');
         $txtMarca.readOnly = true;
         $txtMarca.value = producto.marca;
         document.getElementById('btnCambiarMarca').hidden = false;

         const $txtCategoria = document.getElementById('txtCategoria');
         $txtCategoria.readOnly = true;
         $txtCategoria.value = producto.categoria;
         document.getElementById('btnCambiarCategoria').hidden = false;
         break;
      default:
         break;
   }
   
   quitarAlerta();
   document.getElementById("btnAceptar").value = 'Actualizar';
}
const eliminar = async function eliminar(element) {
   let $codigo = element.getAttribute('id').substring(8);
   console.log($codigo);
   try {
      let options = {
            method: 'POST',
            body: JSON.stringify({codigo: $codigo}),
            headers:{
               'Content-Type': 'application/json'
            }
         },
         response = await fetch('/primer_proyecto/'+tipo+'/destroy', options),
         json = await response.json();
      if (!response.ok) {
         throw {
            status: response.status,
            statusText: response.statusText
         };
      }

      // Código para mostrar resultado
      const $divAlert = document.createElement('div');
      if (json[0] == 'EXITO') {
         $divAlert.setAttribute('class', 'alert alert-dismissible fade show alert-success');
      } else {
         $divAlert.setAttribute('class', 'alert alert-dismissible fade show alert-danger');
      }
      $divAlert.setAttribute('role', 'alert');
      const $iconCheck = document.createElement('i');
      if (json[0] == 'EXITO') {
         $iconCheck.setAttribute('class', 'fas fa-check-circle');
      } else {
         $iconCheck.setAttribute('class', 'fas fa-exclamation-triangle');
      }
      const $mensaje = document.createTextNode(' '+json[1]);
      const $btnClose = document.createElement('button');
      $btnClose.setAttribute('type', 'button');
      $btnClose.setAttribute('class', 'close alertaResultado');
      $btnClose.setAttribute('data-dismiss', 'alert');
      $btnClose.setAttribute('aria-label', 'Close');
      const $span = document.createElement('span');
      $span.setAttribute('aria-hidden', 'true');
      $span.innerHTML = "&times;";

      $btnClose.appendChild($span);
      $divAlert.appendChild($iconCheck);
      $divAlert.appendChild($mensaje);
      $divAlert.appendChild($btnClose);

      // Mostrar alerta de éxito o de error en DELETE
      $cuerpoCard.insertBefore($divAlert, document.getElementById('modal'));
      setTimeout(() => {
         $('.alertaResultado').alert('close');
      }, 3000);
      // Listar elementos
      getList();
   } catch (error) {
      let message = error.statusText || "Ocurrió un error";
      $cuerpoCard.innerHTML = error;
   }
}

const submit = async function submit() {
   let form = new FormData(document.getElementById('form'));
   const $txtCodigo = document.getElementById('txtCodigo');
   console.log($txtCodigo.getAttribute('value'));
   if ($txtCodigo.getAttribute('value') == '') {
      // Create - POST
      //console.log(form);
      try {
         let options = {
               method: 'POST',
               body: form
            },
            response = await fetch('/primer_proyecto/'+tipo+'/store', options),
            json = await response.json();
         if (!response.ok) {
            throw {
               status: response.status,
               statusText: response.statusText
            };
         }

         // Código para mostrar resultado
         const $divAlert = document.createElement('div');
         if (json[0] == 'EXITO') {
            $divAlert.setAttribute('class', 'alert alert-dismissible fade show alert-success');
         } else {
            $divAlert.setAttribute('class', 'alert alert-dismissible fade show alert-danger');
         }
         $divAlert.setAttribute('role', 'alert');
         const $iconCheck = document.createElement('i');
         if (json[0] == 'EXITO') {
            $iconCheck.setAttribute('class', 'fas fa-check-circle');
         } else {
            $iconCheck.setAttribute('class', 'fas fa-exclamation-triangle');
         }
         const $mensaje = document.createTextNode(' '+json[1]);
         const $btnClose = document.createElement('button');
         $btnClose.setAttribute('type', 'button');
         $btnClose.setAttribute('class', 'close');
         $btnClose.setAttribute('data-dismiss', 'alert');
         $btnClose.setAttribute('aria-label', 'Close');
         const $span = document.createElement('span');
         $span.setAttribute('aria-hidden', 'true');
         $span.innerHTML = "&times;";

         $btnClose.appendChild($span);
         $divAlert.appendChild($iconCheck);
         $divAlert.appendChild($mensaje);
         $divAlert.appendChild($btnClose);

         // Mostrar alerta de éxito o de error en POST
         $cuerpoCard.insertBefore($divAlert, document.getElementById('modal'));
         // Listar elementos
         getList();

         $('#modal').modal('hide');
      } catch (error) {
         let message = error.statusText || "Ocurrió un error";
         $cuerpoCard.innerHTML = error;
      }
   } else {
      // Create - POST
      //console.log(form);
      try {
         let options = {
               method: 'POST',
               body: form
            },
            response = await fetch('/primer_proyecto/'+tipo+'/update', options),
            json = await response.json();
         if (!response.ok) {
            throw {
               status: response.status,
               statusText: response.statusText
            };
         }

         // Código para mostrar resultado
         const $divAlert = document.createElement('div');
         if (json[0] == 'EXITO') {
            $divAlert.setAttribute('class', 'alert alert-dismissible fade show alert-success');
         } else {
            $divAlert.setAttribute('class', 'alert alert-dismissible fade show alert-danger');
         }
         $divAlert.setAttribute('role', 'alert');
         const $iconCheck = document.createElement('i');
         if (json[0] == 'EXITO') {
            $iconCheck.setAttribute('class', 'fas fa-check-circle');
         } else {
            $iconCheck.setAttribute('class', 'fas fa-exclamation-triangle');
         }
         const $mensaje = document.createTextNode(' '+json[1]);
         const $btnClose = document.createElement('button');
         $btnClose.setAttribute('type', 'button');
         $btnClose.setAttribute('class', 'close');
         $btnClose.setAttribute('data-dismiss', 'alert');
         $btnClose.setAttribute('aria-label', 'Close');
         const $span = document.createElement('span');
         $span.setAttribute('aria-hidden', 'true');
         $span.innerHTML = "&times;";

         $btnClose.appendChild($span);
         $divAlert.appendChild($iconCheck);
         $divAlert.appendChild($mensaje);
         $divAlert.appendChild($btnClose);

         // Mostrar alerta de éxito o de error en PUT
         $cuerpoCard.insertBefore($divAlert, document.getElementById('modal'));
         // Listar elementos
         getList();

         $('#modal').modal('hide');
      } catch (error) {
         let message = error.statusText || "Ocurrió un error";
         $cuerpoCard.innerHTML = error;
      }
   }
}

// ********   AUTOCOMPLETE SEARCH BARS   ********
const autocompleteSearchBars = function autocompleteSearchBars() {
   const $txtUnidadMedida = document.getElementById('txtUnidadMedida');
   $txtUnidadMedida.addEventListener('keyup', function(){
      let descripcionUnidadMedida = this.value;
      if (descripcionUnidadMedida != '') {
         //console.log(descripcionUnidadMedida);
         $.ajax({
            url: '/primer_proyecto/unidadmedida/searchUnidadMedida',
            method: 'POST',
            data: {
               descripcionUnidadMedida
            },
            success: function(data) {
               //console.log(data);
               const $unidadMedidaList = document.getElementById('unidadMedidaList');
               $unidadMedidaList.hidden = false;
               $unidadMedidaList.innerHTML = data;
            }
         });
      } else {
         $('#unidadMedidaList').html('');
      }
   });
   const $txtMarca = document.getElementById('txtMarca');
   $txtMarca.addEventListener('keyup', function() {
      let descripcionMarca = this.value;
      if (descripcionMarca != '') {
         //console.log(descripcionMarca);
         $.ajax({
            url: '/primer_proyecto/marca/searchMarca',
            method: 'POST',
            data: {
               descripcionMarca
            },
            success: function(data) {
               //console.log(data);
               const $marcaList = document.getElementById('marcaList');
               $marcaList.hidden = false;
               $marcaList.innerHTML = data;
            }
         });
      } else {
         $('#marcaList').html('');
      }
   });
   const $txtCategoria = document.getElementById('txtCategoria');
   $txtCategoria.addEventListener('keyup', function() {
      let descripcionCategoria = this.value;
      if (descripcionCategoria != '') {
         //console.log(descripcionCategoria);
         $.ajax({
            url: '/primer_proyecto/categoria/searchCategoria',
            method: 'POST',
            data: {
               descripcionCategoria
            },
            success: function(data) {
               //console.log(data);
               const $categoriaList = document.getElementById('categoriaList');
               $categoriaList.hidden = false;
               $categoriaList.innerHTML = data;
            }
         });
      } else {
         $('#categoriaList').html('');
      }
   });

   const $btnCambiarUnidadMedida = document.getElementById('btnCambiarUnidadMedida');
   $btnCambiarUnidadMedida.addEventListener('click', function() {
      vaciarUnidadMedida();
   });
   const $btnCambiarMarca = document.getElementById('btnCambiarMarca');
   $btnCambiarMarca.addEventListener('click', function() {
      vaciarMarca();
   });
   const $btnCambiarCategoria = document.getElementById('btnCambiarCategoria');
   $btnCambiarCategoria.addEventListener('click', function() {
      vaciarCategoria();
   });
}

// Vaciar los seleccionados
function vaciarListas() {
   vaciarUnidadMedida();
   vaciarMarca();
   vaciarCategoria();
}
function vaciarUnidadMedida() {
   const $txtUnidadMedida = document.getElementById('txtUnidadMedida');
   $txtUnidadMedida.value = '';
   $txtUnidadMedida.readOnly = false;

   document.getElementById('btnCambiarUnidadMedida').hidden = true;
}
function vaciarMarca() {
   const $txtMarca = document.getElementById('txtMarca');
   $txtMarca.value = '';
   $txtMarca.readOnly = false;

   document.getElementById('btnCambiarMarca').hidden = true;
}
function vaciarCategoria() {
   const $txtCategoria = document.getElementById('txtCategoria');
   $txtCategoria.value = '';
   $txtCategoria.readOnly = false;

   document.getElementById('btnCambiarCategoria').hidden = true;
}

// Seleccionar listas
function selectname_unidadMedida(selected_value) {
   const $txtUnidadMedida = document.getElementById('txtUnidadMedida');
   $txtUnidadMedida.readOnly = true;
   $txtUnidadMedida.value = selected_value;

   document.getElementById('unidadMedidaList').hidden = true;
   document.getElementById('btnCambiarUnidadMedida').hidden = false;
}
function selectname_marca(selected_value) {
   const $txtMarca = document.getElementById('txtMarca');
   $txtMarca.readOnly = true;
   $txtMarca.value = selected_value;

   document.getElementById('marcaList').hidden = true;
   document.getElementById('btnCambiarMarca').hidden = false;
}
function selectname_categoria(selected_value) {
   const $txtCategoria = document.getElementById('txtCategoria');
   $txtCategoria.readOnly = true;
   $txtCategoria.value = selected_value;

   document.getElementById('categoriaList').hidden = true;
   document.getElementById('btnCambiarCategoria').hidden = false;
}
// FIN - Seleccionar listas

// ********   FIN - AUTOCOMPLETE SEARCH BARS   ********


// Quitar alerta del modal
function quitarAlerta() {
   if (document.getElementById('errorDiv')) {
      document.getElementById('filaError').removeChild(document.getElementById('errorDiv'));
   }
}


// ********   VALIDACIÓN FORMULARIO   ********
function validar() {
   var $inputsList = [];
   var errorList = [];
   const numeroDecimal = /^\d+(?:.\d+)?$/;

   let $form = document.getElementById('form');
   $inputsList = $form.getElementsByTagName('input');

   for (const $input of $inputsList) {
      switch ($input.name) {
         case 'txtDescripcion':
            if ($input.value == '') {
               errorList.push('La descripción es obligatoria.');
            } else {
               if ($input.value.length > 200) {
                  errorList.push('No puedes superar los 200 caracteres.');
               }
            }
            break;
         case 'txtPrecioCompra':
            if ($input.value == '') {
               errorList.push('El precio de compra es obligatorio.');
            } else {
               if (!numeroDecimal.test($input.value)) {
                  //console.log("NO VALIDO");
                  errorList.push('El precio de compra no es válido');
               }
            }
            break;
         case 'txtPrecioVenta':
            if ($input.value == '') {
               errorList.push('El precio de venta es obligatorio.');
            } else {
               if (!numeroDecimal.test($input.value)) {
                  errorList.push('El precio de venta no es válido');
               }
            }
            break;
         case 'txtStock':
            if ($input.value == '') {
               errorList.push('El stock es obligatorio.');
            } else {
               if (!numeroDecimal.test($input.value)) {
                  errorList.push('El stock no es válido');
               }
            }
            break;
         case 'txtStockMinimo':
            if ($input.value == '') {
               errorList.push('El stock mínimo es obligatorio.');
            } else {
               if (!numeroDecimal.test($input.value)) {
                  errorList.push('El stock mínimo no es válido');
               }
            }
            break;
         case 'txtMarca':
            if ($input.value == '') {
               errorList.push('La marca es obligatoria.');
            } else {
               if (!$input.readOnly) {
                  errorList.push('Debes seleccionar un elemento de la lista');
               }
            }
            break;
         case 'txtUnidadMedida':
            if ($input.value == '') {
               errorList.push('La unidad de medida es obligatoria.');
            } else {
               if (!$input.readOnly) {
                  errorList.push('Debes seleccionar un elemento de la lista');
               }
            }
            break;
         case 'txtCategoria':
            if ($input.value == '') {
               errorList.push('La categoría es obligatoria.');
            } else {
               if (!$input.readOnly) {
                  errorList.push('Debes seleccionar un elemento de la lista');
               }
            }

            break;
         default:
            break;
      }
   }

   if (errorList.length != 0) {
      var summary = "";
      errorList.forEach(error => {
         summary += "<li>" + error + "</li>";
      });
      //console.log(summary);

      quitarAlerta();

      const $errorDiv = document.createElement('div');
      $errorDiv.setAttribute('id', 'errorDiv');
      $errorDiv.setAttribute('class', 'alert alert-danger alert-dismissible fade show');
      $errorDiv.setAttribute('role', 'alert');
      const $ul = document.createElement('ul');
      $ul.setAttribute('id', 'listaErrores');
      const $button = document.createElement('button');
      $button.setAttribute('type', 'button');
      $button.setAttribute('class', 'close');
      $button.setAttribute('data-dismiss', 'alert');
      $button.setAttribute('aria-label', 'Close');
      const $span = document.createElement('span');
      $span.setAttribute('aria-hidden', 'true');
      $span.innerHTML = "&times;";
      $button.appendChild($span);
      $errorDiv.appendChild($ul);
      $errorDiv.appendChild($button);

      document.getElementById('filaError').appendChild($errorDiv);
      document.getElementById('listaErrores').innerHTML = summary;

      return false;
   } else {
      return true;
   }
}
document.getElementById('form').addEventListener('submit', function(event) {
   event.preventDefault();
   if (validar()) {
      submit();
   }
});
// ********   FIN - VALIDACIÓN FORMULARIO   ********