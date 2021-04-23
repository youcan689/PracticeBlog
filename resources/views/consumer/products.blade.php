@extends('consumer.layout')
@section('content')
    <div v-for="product in products" >
        <v-hover v-slot="{hover}" open-delay="200">
            <v-card color="#FAEBD7" outlined shaped :elevation="hover ? 16 : 2">
                <v-card-title v-text="product.title"></v-card-title>
                <v-card-subtitle v-text="product.price"></v-card-subtitle>
                <v-card-text v-text="product.description"></v-card-text>
            </v-card>
        </v-hover>
    </div>
@endsection
@section('vuejs-instance')
    <script>
        Vue.use(vueMoment);
        new Vue({
            el: '#app',
            data: function() {
                return {
                    products: []
                }
            },
            mounted() {
                var self = this;
                axios.get('products').then(function(response) {
                    self.products = response.data;
                })
            },
            vuetify: new Vuetify(),
        })
    </script>
@endsection
