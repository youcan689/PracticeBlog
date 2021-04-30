@inject('bar', 'Plat\Foundation\Frontend\Bar')
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @push('scripts')
        <script src="/packages/plat/frontend-vuejs/js/vue.js"></script>
        <script src="/packages/plat/frontend-vuejs/js/vuetify.js"></script>
        <script src="/packages/plat/frontend-vuejs/js/axios.js"></script>
        <script src="/packages/plat/frontend-vuejs/js/vue-moment.min.js"></script>
    @endpush
    @stack('scripts')

    <link href="/packages/plat/frontend-vuejs/css/vuetify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

    @yield('head')
</head>

<body>
    <v-app id="app">
        @section('app-bar')
            <v-app-bar app dark color="{{ $bar->getColor() }}">
                @foreach ($bar->getItems() as $side => $items)
                    @foreach ($items as $item)
                        <v-btn href="{{ $item['url'] }}" text>
                            @if (!empty($item['icon']))
                                <v-icon left>{{ $item['icon'] }}</v-icon>
                            @endif
                            {{ $item['title'] }}
                        </v-btn>
                    @endforeach

                    @if ($side != 'right')
                        <v-spacer></v-spacer>
                    @endif
                @endforeach
                @guest
                    <v-btn href="/home">登入</v-btn>
                @endguest
                @auth
                    <v-dialog transition="dialog-top-transition" max-width="600">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn color="primary" v-bind="attrs" v-on="on">我的購買清單</v-btn>
                        </template>
                        <template v-slot:default="dialog">
                            <v-card>
                                <v-toolbar color="primary" dark>我的購買清單</v-toolbar>
                                <v-card-text>
                                    <div class="text-h2 pa-12" v-for="product in cartEnd.products">
                                        <ol>
                                            <li>商品名稱:@{{ product . title }}</li>
                                            <li>商品價格:@{{ product . price }}</li>
                                        </ol>
                                    </div>
                                    <h2>訂單總價格:@{{ cartEnd . cost }}</h2>
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                    <v-btn text @click="dialog.value = false">Close</v-btn>
                                </v-card-actions>
                            </v-card>
                        </template>
                    </v-dialog>
                    </div>
                    <form action="/logout" method="POST">
                        <v-btn type="submit">登出</v-btn>
                        @csrf
                    </form>
                @endauth
            </v-app-bar>
        @show
        <v-content>
            <v-container fluid>
                @yield('content')
            </v-container>
        </v-content>
        <v-footer>
            @yield('footer')
        </v-footer>
    </v-app>
    @yield('vuejs-components')
    @yield('vuejs-instance')
</body>

</html>
