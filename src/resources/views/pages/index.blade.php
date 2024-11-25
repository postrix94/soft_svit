@extends("templates.main")
@section("content")
    <div class="d-flex justify-content-center align-items-center h-100">
        <form method="POST" action="{{route("send_mail")}}" class="row g-3 w-75">
            @csrf
            <div class="col-md-6">
                <label for="from" class="form-label">From*</label>
                <input class="form-control @error("from") is-invalid @enderror" name="from" required value="{{ old('from') }}">
                @error("from")<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="to" class="form-label">To*</label>
                <input type="email" class="form-control @error("to") is-invalid @enderror" id="to"  name="to" required value="{{ old('to') }}">
                @error("to")<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label for="cc" class="form-label">CC</label>
                <input type="email" class="form-control @error("cc") is-invalid @enderror" id="cc" name="cc" value="{{ old('cc') }}">
                @error("cc")<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-8">
                <label for="subject" class="form-label">Subject*</label>
                <input type="text" class="form-control @error("subject") is-invalid @enderror" id="subject" name="subject" required value="{{ old('subject') }}">
                @error("subject")<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label for="type_list" class="form-label">Type</label>
                <select id="type_list" class="form-select" name="type_list">
                    <option selected value="text">text</option>
                    <option value="html">html</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="body_list" class="form-label">Body*</label>
                <textarea class="form-control @error("body_list") is-invalid @enderror" id="body_list" name="body_list" style="min-height: 100px;">{{ old('body_list') }}</textarea>
                @error("body_list")<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success">Send</button>
            </div>
        </form>
    </div>
@endsection
