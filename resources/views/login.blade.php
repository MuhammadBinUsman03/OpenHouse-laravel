<!doctype html>
<html lang="en">
  <head>
    <title>Open House | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <h1>Login</h1>
      <form action="{{ route('auth') }}" method="post">
        @csrf
        <div class="form-group">
          <input type="text" name="username" id="username" class="form-control" placeholder="Username" aria-describedby="username">
          <span class="text-danger">{{ $errors->first('username') }}</span>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          <span class="text-danger">{{ $errors->first('password') }}</span>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </div>
  </body>
</html>