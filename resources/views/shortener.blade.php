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
        <header class="h-30vh-min">
            <img class="logo mt-40 ml-40" src="{{ asset('img/hn-bit-logo.png') }}">
        </header>
        <!-- MAIN -->
        <main class="h-70vh-min">
            <div class="mt-40 ml-40">
                <form>
                    <table>
                        <tr>
                            <td>
                                <input type="url" id="urlInput" name="urlInput" value="" placeholder="http://yoururl.here">
                            </td>
                            <td>
                                <input type="url" id="urlInput" name="urlInput" value="" placeholder="http://yoururl.here">
                            </td>
                            <td><input type="checkbox">Private?</td>
                            <td><button type="submit">Shorten</button></td>
                </form>
            </div>
            <div id="lipsum">
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tincidunt, massa vel laoreet venenatis, nunc sapien congue mauris, a pharetra odio ligula sit amet velit. Nullam et purus in enim tristique congue et dignissim tellus. Quisque ullamcorper rutrum posuere. Duis vehicula nibh id tristique ultricies. Aliquam egestas malesuada sem, ac gravida metus dapibus vel. Nam in auctor lectus, a scelerisque sem. Phasellus fermentum, eros dictum laoreet placerat, nibh dui finibus libero, eu ullamcorper est ex sit amet libero. Donec at elementum ex. Proin gravida fringilla enim. Integer eleifend a enim placerat mollis. Morbi ullamcorper pretium justo, in placerat metus.
</p>
<p>
Quisque a lobortis ipsum. Nullam gravida enim ut blandit ullamcorper. Aenean fringilla ipsum ac justo fringilla facilisis. Suspendisse potenti. Fusce fringilla, tellus in laoreet sollicitudin, metus risus rhoncus odio, at vehicula elit urna non quam. Nullam pulvinar, risus quis facilisis pretium, sapien magna maximus tellus, fringilla commodo metus velit ac ex. Sed risus tellus, facilisis a lacinia quis, tincidunt vitae sapien.
</p>
<p>
In hac habitasse platea dictumst. Curabitur pulvinar, lorem non volutpat efficitur, velit mi mattis turpis, sit amet ullamcorper purus nisl id ante. Praesent fermentum libero ut nisl gravida dictum. Vestibulum eget ullamcorper purus, ac euismod ex. Nam ac ullamcorper ex. Cras dignissim semper orci vitae tincidunt. Mauris a fringilla eros, ornare cursus mi.
</p>
<p>
Aliquam rutrum enim at ornare vestibulum. Duis scelerisque porttitor turpis, et commodo ante porta laoreet. Maecenas eget sapien dolor. Sed congue lacinia nisi, id laoreet justo laoreet eu. Vivamus rhoncus neque venenatis justo laoreet iaculis. Duis fringilla nunc et leo malesuada, at euismod arcu ullamcorper. Proin semper metus neque, vel ultricies turpis efficitur in. Nunc elementum lorem sit amet orci sollicitudin, et mattis ligula tincidunt. Nullam ut diam id quam aliquam tempus sed sit amet purus. Ut nec volutpat enim. Morbi id lorem at diam dignissim tempus at vel odio. Etiam nec dictum dui. Maecenas nec mi vel purus ornare venenatis vitae sed tortor. Pellentesque magna orci, cursus nec elementum quis, commodo eu turpis. Maecenas vel nisi in ex maximus pulvinar.
</p>
<p>
Mauris odio massa, laoreet et tincidunt id, ultrices et metus. Integer laoreet nec tellus vitae euismod. Maecenas dignissim aliquam erat id tincidunt. In velit ligula, laoreet id placerat vel, condimentum at erat. Curabitur bibendum velit in eros pellentesque, at faucibus nunc sollicitudin. Vivamus tristique sem erat, at iaculis elit facilisis ut. Donec varius sem at arcu hendrerit, sit amet dignissim odio euismod. Vivamus vestibulum turpis sollicitudin dui molestie porttitor. Sed vulputate est at turpis pellentesque tempus ut eu lacus. Fusce vitae nulla sit amet dui ullamcorper luctus eget non nibh. Suspendisse potenti. Praesent lacinia bibendum sapien. Suspendisse lacinia leo vitae suscipit feugiat. Aliquam suscipit eu risus commodo ullamcorper. Phasellus euismod nibh massa, sit amet tempus turpis convallis et.
</p></div>
        </main>
        <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min') }}"></script>
    </body>
</html>