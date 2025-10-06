<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Dashboard Desa</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --green-700:#166534;
      --green-500:#22c55e;
      --green-100:#ecfdf5;
      --muted:#6b7280;
      font-family:'Inter',sans-serif;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      background:linear-gradient(180deg,var(--green-100),#166534);
      display:flex;
      align-items:center;
      justify-content:center;
      height:100vh;
    }
    .card{
      background:white;
      padding:40px 32px;
      border-radius:16px;
      box-shadow:0 70px 50px rgba(0, 0, 0, 0.82);
      width:100%;
      max-width:360px;
      text-align:center;
      
    }
    .logo{
      width:64px;
      height:64px;
      border-radius:16px;
      background:linear-gradient(135deg,var(--green-700),var(--green-500));
      display:flex;
      align-items:center;
      justify-content:center;
      color:white;
      font-size:22px;
      font-weight:700;
      margin:0 auto 16px;
    }
    h1{
      font-size:22px;
      color:var(--green-700);
      margin:8px 0 20px 0;
    }
    label{
      display:block;
      text-align:left;
      font-size:14px;
      color:var(--muted);
      margin-bottom:4px;
      margin-top:12px;
    }
    input{
      width:100%;
      padding:10px 12px;
      border-radius:8px;
      border:1px solid #000000ff;
      font-size:14px;
      outline:none;
      transition:border 0.2s;
    }
    input:focus{
      border-color:var(--green-500);
    }
    button{
      margin-top:24px;
      width:100%;
      padding:10px;
      background:var(--green-700);
      color:white;
      border:none;
      border-radius:8px;
      font-weight:600;
      cursor:pointer;
      transition:background 0.2s;
    }
    button:hover{
      background:var(--green-500);
    }
    .footer-text{
      margin-top:16px;
      font-size:13px;
      color:var(--muted);
    }
    a{
      color:var(--green-700);
      text-decoration:none;
      font-weight:500;
    }
  </style>
</head>
<body>
    <div class="card">
        <div class="logo">BD</div>
        <h1>Login Bina Desa</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ( $errors-> all () as $error )
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
      @endif
    <form action="{{ route('auth.store') }}" method="POST">
        @csrf
        <label><b>USERNAME</b></label><br>
        <input type="text" name="username" value="{{ old('username') }}"><br><br>

        <label><b></b></label><br>
        <input type="password" name="password" value="{{ old('password') }}"><br><br>

        <button type="submit">Login</button>
    </form>

</body>
</html>
