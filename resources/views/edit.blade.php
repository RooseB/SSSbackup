<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Page') }}
        </h2>
</x-slot>

    <br/>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100:" style="text-align: center;">
                   <form method="POST" action='{{route('webapp.update', ['webapp' => $id])}}' enctype="multipart/form-data">
                        @csrf
                        {{-- @method('put') --}}
                        <input type="file" name="WebAppTable">
                        <input type="submit" value="Save Changes" style="color:red">
                    </form>
                </div>
            </div>
    

    @if (!empty($id))
        <a href="{{url('/create', [$id, $originalName])}}">{{$id}} {{$originalName}}</a>
        <br/>
    @endif

    

    @isset($id)
        {{$id}}
        <br/>
        {{$originalName}}
        <br/>
        {{$mimeType}}
        <br/>
        {{$path}}
    @endisset

    <br/>
    <br/>
    <h1>if this page refreshes with a file appearing above this it will add a new instance of the file to the database...</h1>
</x-app-layout>