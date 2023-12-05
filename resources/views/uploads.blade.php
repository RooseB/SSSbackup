<x-app-layout>
<br/>
    @foreach ($webapps as $webapp)
        <li value='{{$webapp->id}}'>
            <a href="{{url('/create', [$webapp->id, $webapp->originalName])}}" style="color:red">{{$webapp->id}} {{$webapp->originalName}}</a>
            @auth
            | Username: {{$webapp->user->name}} |
            <form method="POST"
            
                action='{{ route('webapp.change', ['webapp' => $webapp->id, 'id' => $webapp->id])}}' {{-- 403 :D --}} {{--should take you to a screen that lets you pick the file you want to change it to--}}
                style="display:inline!important;"
            >
                @csrf
                @method('get') {{-- Changes post to get --}}
                <input type="submit" value="Edit"  style="display:inline!important;" >
            </form>

            <form method="POST"
                action='{{ route('webapp.decimate', ['webapp' => $webapp->id])}}' {{-- 404 :D--}}
                style="display:inline!important;"            
            >
                @csrf
                @method('delete') {{-- changes post to delete --}}
                <input type="submit" value="Delete"  style="display:inline!important;">
            </form>
            @endauth
        </li>
    @endforeach
</x-app-layout>