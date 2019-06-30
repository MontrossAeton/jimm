<div class="sidebar" data-color="white" data-active-color="danger">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
            </div>
        </a>
        <a href="#" class="simple-text logo-normal">
            Admin
            <!-- <div class="logo-image-big">
                <img src="../assets/img/logo-big.png">
                </div> -->
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ request()->path() === "admin" ? 'active' : '' }}">
                <a href="{{ url('admin') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if (Auth::user()->type === 1)
                <li class="{{ request()->path() === "admin/profile" ? 'active' : '' }}">
                    <a href="{{url('admin/profile')}}">
                        <i class="nc-icon nc-single-02"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                @if (auth()->user()->isPremium())
                    <li class="{{ request()->path() === "admin/gym-images" ? 'active' : '' }}">
                        <a href="{{ route('admin.gym-images.index') }}">
                            <i class="nc-icon nc-image"></i>
                            <p>Gym Images</p>
                        </a>
                    </li>
                    <li class="{{ request()->path() === "admin/services" ? 'active' : '' }}">
                        <a href="{{ route('admin.services.index') }}">
                            <i class="nc-icon nc-box-2"></i>
                            <p>Services
                            </p>
                        </a>
                    </li>
                @endif
            @endif
            @if (auth()->user()->type !== 3)
                @if(auth()->user()->type === 1 && auth()->user()->isPremium())
                    <li class="{{ request()->path() === "admin/posts" ? 'active' : '' }}">
                        <a href="{{ route('admin.posts.index') }}">
                            <i class="nc-icon nc-tile-56"></i>
                            <p>Posts</p>
                        </a>
                    </li>
                    <li class="{{ request()->path() === "admin/feedbacks" ? 'active' : '' }}">
                        <a href="{{ route('admin.feedbacks.index') }}">
                            <i class="nc-icon nc-satisfied"></i>
                            <p>Feedbacks</p>
                        </a>
                    </li>
                    <li class="{{ request()->path() === "admin/reports" ? 'active' : '' }}">
                        <a href="{{ route('admin.reports.index') }}">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                @elseif(auth()->user()->type === 0 || auth()->user()->type === 4)
                    <li class="{{ request()->path() === "admin/posts" ? 'active' : '' }}">
                        <a href="{{ route('admin.posts.index') }}">
                            <i class="nc-icon nc-tile-56"></i>
                            <p>Posts</p>
                        </a>
                    </li>
                    <li class="{{ request()->path() === "admin/feedbacks" ? 'active' : '' }}">
                        <a href="{{ route('admin.feedbacks.index') }}">
                            <i class="nc-icon nc-satisfied"></i>
                            <p>Feedbacks</p>
                        </a>
                    </li>
                    <li class="{{ request()->path() === "admin/reports" ? 'active' : '' }}">
                        <a href="{{ route('admin.reports.index') }}">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                @endif
            @endif
            @if (auth()->user()->type !== 4)
                @if(auth()->user()->type === 1 && auth()->user()->isPremium())
                    <li class="{{ request()->path() === "admin/reservations" ? 'active' : '' }}">
                        <a href="{{ route('admin.reservations.index') }}">
                            <i class="nc-icon nc-calendar-60"></i>
                            <p>Reservations
                                @if(auth()->user()->type === 1)
                                    @if($count_reservations = auth()->user()->gym->reservations()->where('status', 'Pending')->count())
                                        <span class='badge badge-danger'>{{$count_reservations}}</span>
                                    @endif
                                @else
                                    @if($count_pending_reservations)
                                        <span class='badge badge-danger'>{{$count_pending_reservations}}</span>
                                    @endif
                                @endif
                            </p>
                        </a>
                    </li>
                @elseif(auth()->user()->type === 0 || auth()->user()->type === 3)
                    <li class="{{ request()->path() === "admin/reservations" ? 'active' : '' }}">
                        <a href="{{ route('admin.reservations.index') }}">
                            <i class="nc-icon nc-calendar-60"></i>
                            <p>Reservations
                                @if(auth()->user()->type === 1)
                                    @if($count_reservations = auth()->user()->gym->reservations()->where('status', 'Pending')->count())
                                        <span class='badge badge-danger'>{{$count_reservations}}</span>
                                    @endif
                                @else
                                    @if($count_pending_reservations)
                                        <span class='badge badge-danger'>{{$count_pending_reservations}}</span>
                                    @endif
                                @endif
                            </p>
                        </a>
                    </li>
                    <li class="{{ request()->path() === "admin/subscriptions" ? 'active' : '' }}">
                        <a href="{{ route('admin.subscriptions.index') }}">
                            <i class="nc-icon nc-bell-55"></i>
                            <p>Subscriptions
                                @if($count_pending_subs)
                                    <span class='badge badge-danger'>{{$count_pending_subs}}</span>
                                @endif
                            </p>
                        </a>
                    </li>
                    <li class="{{ request()->path() === "admin/locations" ? 'active' : '' }}">
                        <a href="{{ route('admin.locations.index') }}">
                            <i class="nc-icon nc-pin-3"></i>
                            <p>Locations</p>
                        </a>
                    </li>
                    <li class="{{ request()->path() === "admin/gyms" ? 'active' : '' }}">
                        <a href="{{ route('admin.gyms.index') }}">
                            <i class="nc-icon nc-shop"></i>
                            <p>Gyms</p>
                        </a>
                    </li>
                @endif
            @endif
            @if (auth()->user()->isAdmin())
                <li class="{{ request()->path() === "admin/users" ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="nc-icon nc-single-02"></i>
                        <p>Users</p>
                    </a>
                </li>
            @endif
            @if (auth()->user()->isAdmin() || auth()->user()->isPremium())
                <li class="{{ request()->path() === "admin/ads" ? 'active' : '' }}">
                    <a href="{{ route('admin.ads.index') }}">
                        <i class="nc-icon nc-tag-content"></i>
                        <p>Advertisements
                            @if($count_pending_ads)
                            <span class='badge badge-danger'>{{$count_pending_ads}}</span>
                            @endif
                        </p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
