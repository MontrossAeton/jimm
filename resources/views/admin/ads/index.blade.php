@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Ads</h4>
                        </div>
                        <div class="col text-right">
                            <button data-toggle="modal" data-target="#ads-payment-instructions" class="btn btn-info">Payment Instructions</button>
                            <a href="{{ route('admin.ads.create') }}">
                                @if (auth()->user()->isAdmin())
                                    <button class="btn btn-primary">
                                        <i class="nc-icon nc-simple-add"></i>
                                        &nbsp;&nbsp;Add
                                    </button>
                                @else
                                    <button class="btn btn-primary">
                                        Request For Ad
                                    </button>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($ads) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            Size
                                        </th>
                                        <th>
                                            Url
                                        </th>
                                        <th>
                                            User
                                        </th>
                                        <th>
                                            Duration/Price
                                        </th>
                                        <th>
                                            Expiration
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ads as $ad)
                                        <tr>
                                            <td>
                                                {{ $ad->title }}
                                            </td>
                                            <td>
                                                {{ $ad->size }}
                                            </td>
                                            <td>
                                                {{ $ad->url }}
                                            </td>
                                            <td>
                                                {{ $ad->user->name }}
                                            </td>
                                            <td>
                                                {{ $ad->duration }}, ₱{{ $ad->price }}
                                            </td>
                                            <td>
                                                {{ ($ad->expiratioon_date) ? $ad->expiratioon_date->toDayDateTimeString() : 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $ad->status }}
                                            </td>
                                            <td class="text-right">
                                                @if ($ad->status === "Pending" && auth()->user()->isAdmin())
                                                    <form action="{{ route('admin.ads.approve', ['ad' => $ad]) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button class="btn btn-outline-info" type="submit">
                                                            <i class="nc-icon nc-ruler-pencil"></i>
                                                            &nbsp;&nbsp;Approve
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.ads.reject', ["ad" => $ad]) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button class="btn btn-outline-danger" type="submit">
                                                            <i class="nc-icon nc-simple-remove"></i>
                                                            &nbsp;&nbsp;Reject
                                                        </button>
                                                    </form>
                                                @else
                                                    @if (auth()->id() === $ad->user_id)
                                                        @if($ad->status !== "Rejected")
                                                            <a href="{{ route('admin.ads.edit', ['ad' => $ad]) }}">
                                                                <button class="btn btn-outline-info">
                                                                    <i class="nc-icon nc-ruler-pencil"></i>
                                                                    &nbsp;&nbsp;Edit
                                                                </button>
                                                            </a>
                                                        @endif
                                                        <button data-toggle="modal" data-target="#delete_ad{{ $ad->id }}" class="btn btn-outline-danger">
                                                            <i class="nc-icon nc-simple-remove"></i>
                                                            &nbsp;&nbsp;Delete
                                                        </button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="delete_ad{{ $ad->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenteredLabel">Delete Ad?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this ad?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <form action="{{ route('admin.ads.destroy', ['ad' => $ad]) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        No ads yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('ads-payment-instructions-modal')
@endsection
