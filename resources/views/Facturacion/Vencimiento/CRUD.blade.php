@extends('layouts.app')

@section('content')


<h1>VENCIMIENTO</h1>

<div class="container">

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">{{'#'}}</th>
            <th scope="col">Factura</th>
            <th scope="col">Cliente</th>
            <th scope="col">Fecha de vencimiento</th>
            <th scope="col">Estado</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach($vencimientos as $vencimiento)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                            {{-- Obtener el código del producto relacionado a través de la factura --}}
                            @if ($vencimiento->factura && $vencimiento->factura->detalleFactura->first())
                                {{$vencimiento->factura->detalleFactura->first()->Observaciones}}
                            @else
                                Sin Producto
                            @endif
                        </td>
                        {{--  <td>{{ $vencimiento->factura->fecha_Vencimiento ?? 'Sin fecha' }}</td>  --}}
                        <td>{{$vencimiento->factura->clientes_facturas->nombreCompleto}}</td>
                        <td>{{ $vencimiento->Avisos }}</td>
                        <td>   <span class="badge text-bg-success">{{ $vencimiento->Estado }}</span></td>
                    </tr>
                @endforeach
        </tbody>
      </table>


</div>





@endsection