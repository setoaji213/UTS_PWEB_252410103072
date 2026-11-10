@extends('layouts.app')

@section('title', 'Akun')

@section('content')
    <h1 class="h1">Akun Saya</h1>

    <section class="idcard">
        <div class="photo">{{ strtoupper(substr($username, 0, 1)) }}</div>
        <dl>
            @foreach ($info as $label => $value)
                <div>
                    <dt>{{ $label }}</dt>
                    <dd>{{ $value }}</dd>
                </div>
            @endforeach
        </dl>
    </section>
@endsection
