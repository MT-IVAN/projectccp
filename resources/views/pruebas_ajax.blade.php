

<div id = "paginacionAjax">
<table class="table">
                        <thead>
                             <tr data-toggle="tooltip" data-placement="top" title="Clic para ordenar">
                                <th>Nombre</th>
                                <th>Fecha de creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="lst_publicadas">
                        @foreach($pruebasNoEditable as $prueba)
                                <tr>
                                    <td>{{$prueba->nombre}}</td>
                                    <td>{{$prueba->created_at}}</td>
                                    <td>
                                        @if (!$prueba->visible)
                                            <button name="prueba/{{$prueba->id}}" class="btn btn-success btn_prueba">Active</button>
                                        @else
                                            <button name="prueba/{{$prueba->id}}" class="btn btn-warning btn_prueba">Desactivar</button>
                                        @endif
                                        <a href="prueba_details/{{$prueba->id}}" class="btn btn-info">Detalles</a>
                                        <a href="#" class="btn btn-default">Resultados</a>
                                    </td>
                                </tr>
                        @endforeach

                        </tbody>
                    </table>

</div>