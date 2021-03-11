@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.reports_page.publisher_reports')</h1>
<div id="sa" class="sa">
<label for="to">Publisher Name  </label>
<label for="to">Publisher Name  </label>
<label for="to">Publisher Name  </label>
<input type='text' id="to" name="to"/>
<button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>
<button type="button" name="reset" id="reset" class="btn btn-danger">Reset</button>
</div>
<input id="s" type="hidden" value=" {{$iso}} ">
<input id="ss" type="hidden" value="{{$rate1}}">
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zero_config" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Publisher Name</th>
                    <th>Currency</th>
                    <th>Payment</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data  as $report)
                    <tr>
                        <td>{{$report->order_id}}</td>
                        <td>{{$report->publisher_name}}</td>
                        <td>{{$report->currency_iso}}</td>
                        <td>{{$report->price}}</td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                    <td style="font-weight:bold">Total</td>
                    <td></td>
                    <td></td>
                    <td id='sum' style="font-weight:bold">{{$sum}} {{$iso}}</td>
                </tr>
                </tfoot>
            </table>














{{--            <table id="zero_config" class="table table-bordered table-striped">--}}
{{--                <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Order ID</th>--}}
{{--                        <th>Publisher Name</th>--}}
{{--                        <th>Currency</th>--}}
{{--                        <th>Payment</th>--}}
{{--                    </tr>--}}
{{--                </thead>--}}
{{--                <tfoot>--}}
{{--                <tr>--}}
{{--<td style="font-weight:bold">Total</td>--}}
{{--<td></td>--}}
{{--<td></td>--}}
{{--<td id='sum' style="font-weight:bold"></td>--}}
{{--                </tr>--}}
{{--        </tfoot>--}}
{{--            </table>--}}
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
$(document).ready(function(){



fill_datatable();

function fill_datatable(to=''){
   var Table=$('#zero_config').DataTable({
        paging: true,
        autoWidth: true,
        lengthChange: true,
        dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{ url('reports1/')}}"+$pubName,
            data:{name:to,}
        },
        columnDefs: [{
                    targets: "_all",
                    orderable: true
                 }],
                 "aoColumns": [
              { mData: 'order_id' } ,
              { mData: 'publisher_name' },
              { mData: 'currency_iso' },
              { mData: 'price' }

            ],
        drawCallback: function(){
Table.columns(3, {
page: 'current'
}).every(function() {
var sum = this
.data()
.reduce(function(a, b) {
var x = parseFloat(a) || 0;
var y = parseFloat(b) || 0;
return x + y;
}, 0);
//console.log(sum); alert(sum);
$(this.footer()).html(sum);
var total=sum*document.getElementById('ss').value;
document.getElementById('sum').innerHTML=total+document.getElementById('s').value;
});
},
        buttons: [
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible:not(.not)' // indexes of the columns that should be printed,
                    }                      // Exclude indexes that you don't want to print.
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:not(.not)'
                    }

                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible:not(.not)'
                    }

                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible:not(.not)'
                    }
                }
                 ],
         columns: [
                {
                    data:'order_id',
                    name:'OrderID'
                },
                {
                    data:'publisher_name',
                    name:'PublisherName'
                },
                {
                    data:'currency_iso',
                    name:'Currency'
                },
                {
                    data:'price',
                    name:'Payment'
                },
                ]
    });
}

$('#filter').click(function(){
        var to = $('#to').val();
        if(to != '')
        {
            $('#zero_config').DataTable().destroy();
            fill_datatable(to);
        }
        else
        {
            alert("Please fill the field first");
        }
});
$('#reset').click(function(){
        $('#to').val('');
        $('#zero_config').DataTable().destroy();
        fill_datatable();
    });


});

</script>


@stop
