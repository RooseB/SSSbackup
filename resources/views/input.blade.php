<x-app-layout>
<x-slot name="header">
    <h1>The Input Page</h1>
    <p>Here you can see what you have uploaded.</p>
</x-slot>


    <p>Or I hoped it would...</p>
    <br/>

    <p>My thinking was to do something like this:</p>

    <textarea rows="6" cols="70" readonly>
        use Maatwebsite\Imports;
        use App\Imports\UserImport;

        Excel::import(new UserImport)->Storage(request()->file('$id','$originalName'));
    </textarea>
{{-- {{route("profile.show")}}; --}}

</x-app-layout>