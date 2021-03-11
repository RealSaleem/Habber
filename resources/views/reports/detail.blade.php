@extends('layouts.app')
@section('content')

<h1 class="page-title">@lang('messages.reports_page.publisher_reports')</h1>
<div id="sa" class="sa">
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
                    <th>Currency</th>
                    <th>Payment</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data  as $report)
                    <tr>
                        <td>{{$report->order_id}}</td>
                        <td>{{$report->currency_iso}}</td>
                        <td>{{$report->price}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="font-weight:bolder;  font-size: 21px;">Total</td>
                    <td></td>
                    <td id='sum' style="font-weight:bold;  font-size: 21px;">{{$sum}} {{$iso}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            var Table = $('#zero_config').DataTable({

                paging: true,
                autoWidth: false,
                lengthChange: true,
                dom: 'Bfrtip',
                processing: true,

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

            });
        });
    </script>
@endsection
