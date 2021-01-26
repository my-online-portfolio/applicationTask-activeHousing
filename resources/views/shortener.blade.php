<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">-->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
            <!-- HEADER -->
            <header class="h-30pc pt-40 pb-40">
                <section class="mt-0">
                    <img class="logo" src="{{ asset('img/hn-bit-logo.png') }}">
                </section>
            </header>
            <!-- MAIN -->
            <main class="h-70pc pb-6pc">
                <section class="mr-40">
                    <div>
                        <form method="POST">
                            @csrf   
                            <table>
                                <tr>
                                    <td>
                                        <input type="url" id="urlInput" name="urlInput" value="{{$URL['userURL'] ?? null}}" placeholder="http://yoururl.here">
                                    </td>
                                    <td>
                                        <input type="url" id="urlOutput" name="urlOutput" value="{{$URL['shortGeneratedURL'] ?? null}}" placeholder="http://yoururl.here" readonly>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="privateCheck" name="privateCheck" value="1"><label class="ml-10">Private?</label>
                                    </td>
                                    <td>
                                        <button type="submit" class="pt-2 pr-25 pb-2 pl-25">Shorten</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </section>
                <section class="mr-95">
                    <h1>Recent Links</h1>
                    <div class="container">
                        @foreach($recentList as $key => $data)
                            <div class="row px-10">
                                <div class="link-short"><a href="{{asset('')}}{{$data->generated_url}}" target="_blank">{{asset('')}}{{$data->generated_url}}</a></div>
                                <div class="mt-10">{{$data->date_added}}</div>
                                <div class="link-long mb-10">{{$data->user_url}}<span class="sub">{{$data->description}}</span></div>
                                <input type=hidden value="" id="UUID">
                            </div>
                        @endforeach
                    </div>
                </section>
            </main>
        <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min') }}"></script>
    </body>
</html>