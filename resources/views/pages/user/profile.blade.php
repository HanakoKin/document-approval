@extends('index')

@section('container')

<section class="content pt-0">

    @if(session()->has('success'))
    @include('script.success')
    @endif

    @if(session()->has('error'))
    @include('script.error')
    @endif

    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7 col-12">
                    <div class="box">
                        <div class="text-white box-body bg-img text-center pt-50 pb-20"
                            style="background-image: url(https://source.unsplash.com/600x400?flower);" data-overlay="5">
                            <a href="#">
                                <img class="avatar avatar-xxl rounded-circle bg-warning-light"
                                    src="https://source.unsplash.com/200x200?people" alt="">
                            </a>
                            <h5 class="my-2"><a class="text-white" href="#">{{ $user->nama }}</a></h5>
                            <span>{{ !$user->unit ? 'Admin' : $user->unit }}</span>
                        </div>
                        <ul class="flexbox flex-justified text-center p-20">
                            <li class="be-1 bs-1 border-light">
                                <span class="text-muted">Jumlah kasus</span><br>
                                <span class="fs-20">{{ $total }} kasus</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
