@extends("templates.main")
@section("content")
    <div class="row d-flex justify-content-center">
        <div class="col-6 mt-5">
            <ul>
                <li>From: {{$email->from}}</li>
                <li>To: {{$email->to}}</li>
                @if(!is_null($email->cc))
                <li>CC: {{$email->cc}}</li>
                @endif
                <li>Type: {{$email->type}}</li>
                <li class="mt-3">
                    @if($email->type === "text")
                        <iframe style="width: 100%;min-height: 500px" srcdoc="{{e($email->body)}}"></iframe>
                    @else
                        <iframe style="width: 100%;min-height: 500px" srcdoc="{{$email->body}}"></iframe>
                    @endif
                </li>
            </ul>
        </div>
    </div>
@endsection


