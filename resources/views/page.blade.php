<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<div class="row">
<div class="container col-md-6 col-md-offset-3">
  <table class="table">
    <tr>
      <th>name</th>
    </tr>
    @forelse($page as $data)
    <tr>
      <td>{{$data->name}}</td>
    </tr>
    @empty
    <tr>
      <td colspan=2>empty</td>
    </tr>
    @endforelse
  </table>
</div>
</div>
@if($page)
            <div class="text-center">
                <div class="panel-heading">{!!$page->render()!!}</div>
            </div>
@endif

