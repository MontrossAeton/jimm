@extends('layouts.pdf')

@section('content')
    <div class="row">
        <div class="col-12">
            <h3><strong>User Activity Logs</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if (count($logs) > 0)
                <table class="table table-striped">
                    <thead class="text-primary">
                        <tr>
                            <th>Time</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>
                                    {{ $log->created_at->toDateTimeString() }}
                                </td>
                                <td>
                                    {{ $log->description }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                No logs yet.
            @endif
        </div>
    </div>
@endsection
