<head>
    <title>Input page</title>
</head>
<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Page') }}
        </h2>
</x-slot>

    <br/>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100:" style="text-align: center;">
                    <form method="POST" action='{{route("webapp.store")}}' enctype="multipart/form-data">

                        @csrf
                        
                        <input type="file" name="WebAppTable">
                        
                        <input type="submit" value="Save the Upload" style="color:red">
                    </form> 
                </div>
            </div>
    

    @if (!empty($id))
        <p>Link to view:</p>
        <a href="{{url('/create', [$id, $originalName])}}" style="color:red">{{$id}} {{$originalName}}</a>
        <br/>
        <br/>
    @endif

    

    @isset($id)
        <p>Details:</p>
        ID:
        {{$id}}
        <br/>
        Original Name:
        {{$originalName}}
        <br/>
        Mimetype:
        {{$mimeType}}
        <br/>
        {{$path}}
    @endisset

    <br/>
    <br/>
    <h1>if this page refreshes with a file appearing above this it will add a new instance of the file to the database...</h1>
</x-app-layout>