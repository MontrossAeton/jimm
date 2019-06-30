@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Reports</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        User Activity Logs
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.reports.user-logs' )}}" class="btn btn-outline-primary generate-report">
                                            <i class="nc-icon nc-single-copy-04"></i>
                                            &nbsp;&nbsp;Generate Report
                                        </a>
                                    </td>
                                </tr>
                                @if (auth()->user()->type !== 1)
                                    <tr>
                                        <td>
                                            System Users
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.reports.system-users' )}}" class="btn btn-outline-primary generate-report">
                                                <i class="nc-icon nc-single-copy-04"></i>
                                                &nbsp;&nbsp;Generate Report
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Customers
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.reports.customers' )}}" class="btn btn-outline-primary generate-report">
                                                <i class="nc-icon nc-single-copy-04"></i>
                                                &nbsp;&nbsp;Generate Report
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Gym Companies
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.reports.gym-companies' )}}" class="btn btn-outline-primary generate-report">
                                                <i class="nc-icon nc-single-copy-04"></i>
                                                &nbsp;&nbsp;Generate Report
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Subscriptions
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.reports.subscriptions' )}}" class="btn btn-outline-primary generate-report">
                                                <i class="nc-icon nc-single-copy-04"></i>
                                                &nbsp;&nbsp;Generate Report
                                            </a>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                            Services
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.reports.services' )}}" class="btn btn-outline-primary generate-report">
                                                <i class="nc-icon nc-single-copy-04"></i>
                                                &nbsp;&nbsp;Generate Report
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Reservations
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.reports.reservations' )}}" class="btn btn-outline-primary generate-report">
                                                <i class="nc-icon nc-single-copy-04"></i>
                                                &nbsp;&nbsp;Generate Report
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Ratings and Reviews
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.reports.ratings-and-reviews' )}}" class="btn btn-outline-primary generate-report">
                                                <i class="nc-icon nc-single-copy-04"></i>
                                                &nbsp;&nbsp;Generate Report
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
