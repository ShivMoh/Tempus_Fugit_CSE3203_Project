
@foreach ($suppliers as $supplier )
    {{$supplier['contact']->email}} <br>
    {{$supplier['supplier']->description}} <br>
@endforeach
