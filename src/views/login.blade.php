@extends('auth::layouts.main')
@section('content')
    <div class="container">
        <div class="login">
            <header class="title">
                <h1>{{ trans('auth::login.title') }}</h1>
            </header>
            @if (Session::has('attempt'))
                <div class="error">
                    <p>{{ trans('auth::messages.attempt.failed') }}</p>
                </div>
            @endif
            <form method="post" action="{{ URL::route('auth/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <div class="control-group">
                        <label>Email address</label>
                        <input type="text" name="email" value="{{ Input::old('email') }}" autofocus>
                    </div>
                    <div class="control-group">
                        <label>Password</label>
                        <input type="password" name="password">
                    </div>
                </fieldset>
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
@stop
