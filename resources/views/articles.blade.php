<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<div class="row">
<div class="container col-md-6 col-md-offset-3">
  <table class="table">
    <thead>
    <tr>
      <th>title</th>
      <th>content</th>
    </tr>
    </thead>
    <tbody>
    @forelse($articles as $article)
    <tr>
      <td>{{$article->title}}</td>
      <td>{{$article->content}}</td>	
    </tr>
    @empty
    <tr>
      <td colspan=2>empty</td>
    </tr>
    @endforelse
    </tbody>
    <tfoot>
    <tr>
      <td colspan=2>{{$articles->render()}}</td>
    </tr>
    </tfoot>
  </table>
</div>
</div>

