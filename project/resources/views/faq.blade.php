@extends('includes.newmaster')

@section('content')


    <section style="background: url({{url('/')}}/assets/images/{{$settings[0]->background}}) no-repeat center center; background-size: cover;">
        <div class="row" style="background-color:rgba(0,0,0,0.7);">

            <div style="margin: 3% 0px 3% 0px;">
                <div class="text-center" style="color: #FFF;padding: 20px;">
                    <h1>{{$language->faq}}</h1>
                </div>
            </div>

        </div>
    </section>

    <div class="home-wrapper">
        <!-- Starting of faq area -->
        <div class="section-padding wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="styled-faf-fullDiv">
                            <div class="panel-group product-faq" id="asked-questions">
                                @foreach($faqs as $faq)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <a href="#asked-questions-{{$faq->id}}" data-parent="#asked-questions" data-toggle="collapse" aria-expanded="false">
                                                {{$faq->question}}
                                            </a>
                                        </div>
                                        <div id="asked-questions-{{$faq->id}}" class="panel-collapse collapse" aria-expanded="false">
                                            <div class="panel-body">
                                                <p>{!! $faq->answer !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of faq area -->
    </div>

@stop

@section('footer')

@stop