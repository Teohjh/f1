<table>
    <tr>
        <td>access token</td>
    </tr>
    <tr>
        <td>name</td>
    </tr>
    <tr>
        <td>id</td>
    </tr>
@foreach ($collection as $item)
    <tr>
        <td>{{$item['access_token']}}
        </td>
    </tr>
    <tr>
        <td>{{$item['name']}}
        </td>
        
        <td>{{$item['id']}}
        </td>
    </tr>
@endforeach
</table>