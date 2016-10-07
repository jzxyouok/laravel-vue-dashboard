@extends('layouts.dashboard-app')

@section('content')

    @javascript(compact('pusherKey'))
    @javascript('userData', Auth::user())
    @javascript('isGuest', Auth::guest())

    <dashboard-navbar></dashboard-navbar>

    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="dashboard-container container-fluid">

                <dashboard-sidebar></dashboard-sidebar>

                <section class="dashboard-content">
                    <div class="row">
                        <div class="col-md-12">
                            <dashboard-fullcalendar></dashboard-fullcalendar>
                            @if (isset($calendar))
                                {!! $calendar->calendar() !!}
                                {!! $calendar->script() !!}
                            @endif
                        </div>
                    </div>
                </section>
                <div class="clearfix"></div>

            </div>
        </div>
    </div>

@endsection

