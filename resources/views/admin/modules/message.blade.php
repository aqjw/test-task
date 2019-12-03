@if(session('message'))
    <div class="alert alert-{{ session('message.type', 'info')}}" role="alert">
        @php($message = session('message.text') ?: session('message'))
        <strong>{{ $message }}</strong>
    </div>
@endif