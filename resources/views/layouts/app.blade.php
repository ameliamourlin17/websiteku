<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Manajemen Formulir') - KAI</title>
    <link rel="icon" href="{{ asset('images/logo-kai.png') }}">
    <style>
        :root {
            --navy: #2d2b70;
            --orange: #ec6b23;
            --bg: #f4f5f9;
            --line: #d9dce6;
            --ink: #1b1c2e;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background: var(--bg);
            color: var(--ink);
        }

        header.top {
            background: #fff;
            border-bottom: 3px solid var(--orange);
        }

        header.top .in {
            max-width: 1100px;
            margin: auto;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        header.top img {
            height: 38px;
        }

        header.top b {
            color: var(--navy);
            font-size: 18px;
        }

        main {
            max-width: 1100px;
            margin: 24px auto;
            padding: 0 20px;
        }

        .card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 22px;
            margin-bottom: 18px;
        }

        .card h2 {
            margin: 0 0 14px;
            font-size: 16px;
            color: var(--navy);
        }

        .grid {
            display: grid;
            gap: 14px;
        }

        .g3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .g2 {
            grid-template-columns: repeat(2, 1fr);
        }

        @media (max-width:800px) {

            .g3,
            .g2 {
                grid-template-columns: 1fr;
            }
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        input[type=text],
        input[type=number],
        input[type=date],
        input[type=time],
        select,
        textarea {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #c5c9d8;
            border-radius: 6px;
            font: inherit;
            background: #fff;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid rgba(236, 107, 35, .45);
            border-color: var(--orange);
        }

        .btn {
            display: inline-block;
            border: 0;
            border-radius: 6px;
            padding: 9px 18px;
            font: inherit;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            text-decoration: none;
            background: var(--navy);
        }

        .btn.orange {
            background: var(--orange);
        }

        .btn.red {
            background: #d32f2f;
        }

        .btn.green {
            background: #1b8a3a;
        }

        .btn.gray {
            background: #6b7185;
        }

        .btn.sm {
            padding: 5px 11px;
            font-size: 13px;
        }

        .alert {
            background: #e7f6ec;
            border: 1px solid #9bd5af;
            color: #14532d;
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 16px;
        }

        .err {
            background: #fdecea;
            border: 1px solid #f1a9a0;
            color: #7a1c14;
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 16px;
        }

        .err ul {
            margin: 6px 0 0 18px;
            padding: 0;
        }

        table.list {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table.list th,
        table.list td {
            text-align: left;
            padding: 9px 10px;
            border-bottom: 1px solid var(--line);
        }

        table.list th {
            background: #eef0f7;
            color: var(--navy);
        }

        .scroll {
            overflow-x: auto;
        }

        table.cek {
            border-collapse: collapse;
            width: 100%;
            min-width: 720px;
        }

        table.cek th,
        table.cek td {
            border: 1px solid var(--line);
            padding: 6px;
            font-size: 13px;
            vertical-align: middle;
        }

        table.cek th {
            background: #eef0f7;
            color: var(--navy);
        }

        table.cek td.s {
            font-weight: 600;
            width: 240px;
        }

        .muted {
            color: #6b7185;
            font-size: 13px;
        }
    </style>
    @stack('head')
</head>

<body>
    @hasSection('bare')
        @yield('bare')
    @else
        <header class="top">
            <div class="in">
                <img src="{{ asset('images/logo-kai.png') }}" alt="KAI">
                <b>Sistem Manajemen Formulir</b>
            </div>
        </header>
        <main>
            @if (session('sukses'))
                <div class="alert">{{ session('sukses') }}</div>
            @endif
            @yield('content')
        </main>
    @endif
</body>

</html>
