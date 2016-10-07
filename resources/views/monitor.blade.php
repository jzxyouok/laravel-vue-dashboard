@extends('layouts.monitor-app')

@section('content')

    @javascript(compact('pusherKey'))
    @javascript('userData', Auth::user())
    @javascript('isGuest', Auth::guest())

    <dashboard-navbar></dashboard-navbar>

    <service-bureau-calendar grid="a1:a3"></service-bureau-calendar>

    <diversified-calendar grid="b1:b3"></diversified-calendar>

    <last-fm grid="c1:c1"></last-fm>
    
    <current-time grid="d1:d1" dateformat="ddd MMM D, YYYY"></current-time>

	<service-bureau-task grid="c2:c3"></service-bureau-task>

	<diversified-task grid="d2:d3"></diversified-task>

    <payment grid="a4:a5"></payment>

    <freshdesk grid="b4:c5"></freshdesk>

    <vonage grid="d4:d5"></vonage>

@endsection