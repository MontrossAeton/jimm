@extends('layouts.admin')

@section('content')
    @if (auth()->user()->isAdmin())
        <div class="row">
            <div class="col-3">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-single-02 text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category">Users</p>
                                    <p class="card-title">{{ $users_count }}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card" >
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Audit Logs</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="height: 500px !important; overflow: scroll; margin-bottom: 20px;">
                    @if (count($logs) > 0)
                        <div class="table-responsive">
                            <table class="table" >
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
                        </div>
                    @else
                        No logs yet.
                    @endif
                </div>
                <div class="card-footer">
                    {{ $logs->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
