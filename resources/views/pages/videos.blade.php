@extends('layouts.default')

@section('content')
    <section>
        <div class="container">
            <video width="80%;" style="margin: auto; display: block" controls>
                <source src="/assets/video/{{ $id }}.mp4" type="video/mp4">
            </video>
        </div>
    </section>
@endsection
