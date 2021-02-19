@extends('layouts.app')
@section('content')    
<h1 class="page-title">@lang('messages.reports_page.sale_reports')</h1> 
<div id="sa" class="sa">
<label for="from">From</label>
<input type="date" id="from" name="from" />
<label for="to">To</label>
<input type="date" id="to" name="to"/>
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
                        <th>Payment</th> 
                        <th>Currency</th>
                    </tr>
                </thead>
                <tfoot>
                <tr>
<td style="font-weight:bold">Total</td>
<td></td>
<td ></td>
<td id='sum' style="font-weight:bold"></td>
                </tr>
        </tfoot>
            </table>
        </div>   
    </div>    
</div>
@endsection
@section('scripts')

<script>
$(document).ready(function(){



fill_datatable();

function fill_datatable(to='',from=''){
   var Table=$('#zero_config').DataTable({
        paging: true,
        autoWidth: true,
        lengthChange: true,
        dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{ route('reports.index') }}",
            data:{to:to, from:from}
        },
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
                
                // 'csv', 'excel', 'pdf', 'print',
             
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
    var from = $('#from').val();
        var to = $('#to').val();
        if(from != '' &&  to != '')
        {
            $('#zero_config').DataTable().destroy();
            fill_datatable(from, to);
        }
        else
        {
            alert('Select Both filter option');
        }
});
$('#reset').click(function(){
        $('#from').val('');
        $('#to').val('');
        $('#zero_config').DataTable().destroy();
        fill_datatable();
    });

   
});

</script>


@stop
