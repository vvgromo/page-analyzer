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
            <h2 class="mt-5 mb-3">Checks</h2>
            <form method="post" action="{{route('checks.store', $domain->id)}}">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="Run check">
            </form>
            <table class="table table-bordered table-hover text-nowrap">
                <tr>
                    <th>Id</th>
                    <th>Status Code</th>
                    <th>h1</th>
                    <th>Keywords</th>
                    <th>Description</th>
                    <th>Created At</th>
                </tr>
                @foreach($domainChecks as $check)
                <tr>
                    <td>{{$check->id}}</td>
                    <td>{{$check->status_code}}</td>
                    <td>{{$check->h1}}</td>
                    <td>{{$check->keywords}}</td>
                    <td>{{$check->description}}</td>
                    <td>{{$check->created_at}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </main>
@endsection
