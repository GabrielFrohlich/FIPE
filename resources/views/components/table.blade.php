<div class="container mx-auto py-2">
    <table class="table table-striped">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th scope="col">{{ $column }}</th>
                @endforeach
                <th scope="col">ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tableData as $item)
                <tr>
                    @foreach ($columns as $column)
                        <td>{{ $item[$column] }}</td>
                    @endforeach
                    <td>
                        <a href="{{$baselink}}/{{$item['codigo']}}" class="btn btn-primary">Exibir</a>                 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>