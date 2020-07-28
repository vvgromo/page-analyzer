@extends("layouts.app")

@section('main')
    <main class="flex-grow-1">
        <div class="container-lg">
            <h1 class="mt-5 mb-3">Site: {{$domain->name}}</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    @foreach($domain as $key => $item)
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$item}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </main>
@endsection
