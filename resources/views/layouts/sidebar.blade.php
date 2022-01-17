<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
{{--        <img src="https://infyom.com/images/logo/blue_logo_150x150.jpg"--}}
{{--             alt="AdminLTE Logo"--}}
{{--             class="brand-image img-circle elevation-3">--}}
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

{{--    <div class="sidebar">--}}
{{--        <nav class="mt-2">--}}
{{--            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('home') }}" class="nav-link active">--}}
{{--                        <i class="nav-icon fas fa-home"></i>--}}
{{--                        <p>Home</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <div class="form-inline" method="GET" action={{action('FilterData@index')}} id="filterdata">--}}
{{--                    <form class="form-horizontal">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="form-group row">--}}
{{--                                <div class=".input-group.input-group-sm">--}}
{{--                                    <select  name="ips">--}}
{{--                                        <option value="">Election Year</option>--}}
{{--                                        @foreach($year_of_election as $year)--}}
{{--                                            {--}}
{{--                                            <option data-placeholder="Year" value="{{$year->election_year_id}}">{{$year->election_year}}</option>--}}
{{--                                            }--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group row">--}}
{{--                                <div class="col-sm-10">--}}
{{--                                    <select  name="region">--}}
{{--                                        <option value=""> Select Region</option>--}}
{{--                                    @foreach($region as $region)--}}
{{--                                            {--}}
{{--                                            <option placeholder="Regions" value="{{$region->region_id}}">{{$region->name}}</option>--}}
{{--                                            }--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.card-body -->--}}
{{--                        <div class="card-footer">--}}
{{--                            <button type="submit" class="btn btn-info">Sign in</button>--}}
{{--                        </div>--}}
{{--                        <!-- /.card-footer -->--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </ul>--}}
{{--        </nav>--}}
{{--                </div>--}}

{{--                <li class="nav-item">--}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-chart-pie"></i>--}}
{{--                        <p>--}}
{{--                            Charts--}}
{{--                            <i class="right fas fa-angle-left"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="pages/charts/chartjs.html" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                @foreach($year_of_election as $year)--}}
{{--                                    <option value="{{$year->election_year_id}}">{{$year->election_year}}</option>--}}
{{--                                @endforeach--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="pages/charts/flot.html" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Flot</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="pages/charts/inline.html" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Inline</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="pages/charts/uplot.html" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>uPlot</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--            </ul>--}}
        </nav>
    </div>

</aside>
