<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">


        <!-- Scripts -->
        </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                </div>
            </header>
            <h3>
                Number of goods
            </h3>
            <main>
                @foreach ($product as  $key => $item)
                    <table>
                        <tr>
                            <td>
                                {{ $key }} -
                            </td>
                            <td>
                                {{ $item }}
                            </td>
                        </tr>
                    </table>
                @endforeach
            </main>
        </div>
    </body>
</html>
