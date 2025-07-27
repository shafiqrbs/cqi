@if($kpi->kpiValues)
    @foreach($kpi->kpiValues as $value)
        <tr>
            <td>
                {{$value->particular_type->name}}
            </td>
            <td>{{$value->kpi_value}}</td>
            <td><button type="button" data-id="{{$value->id}}" class="btn btn-danger btn-sm record_delete">X</button></td>
        </tr>
    @endforeach
@endif