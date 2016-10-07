{{-- <div class="container-fluid"> --}}
    <section class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
                {!! $calendar->calendar() !!}
                {!! $calendar->script() !!}
            </div>
        </div>
    </section>
    <div class="clearfix"></div>

{{-- </div> --}}
