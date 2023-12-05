<form method="POST" action='{{url("/")}}' enctype="multipart/form-data">
    @csrf
    @method('put')
    <input type="file" name="upload">
    <input type="submit" value="Save Upload">
</form>

@if (!empty($id))
    <a href="{{url('/', [$id, $originalName])}}">{{$id}} {{originalName}}</a>
    <br/>
@endif

<a href="{{url('/dashboard')}}">Web App Home Page </a>

@isset($id)
    {{$id}}
    <br/>
    {{$originalName}}
    <br/>
    {{$mimeType}}
    <br/>
    {{$path}}
@endisset