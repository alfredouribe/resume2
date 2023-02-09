/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('infocomponent', require('./components/InfoComponent.vue').default);
Vue.component('consolecomponent', require('./components/ConsoleComponent.vue').default);
Vue.component('clockcomponent', require('./components/ClockComponent.vue').default);
Vue.component('ipcomponent', require('./components/IpComponent.vue').default);
Vue.component('keyboardcomponent', require('./components/KeyboardComponent.vue').default);
// Vue.component('worldcomponent', require('./components/WorldComponent.vue').default);
Vue.component('commandscomponent', require('./components/CommandsComponent.vue').default);
Vue.component('gamecomponent', require('./components/GameComponent.vue').default);
Vue.component('fightercomponent', require('./components/FighterComponent.vue').default);
// Vue.component('carcomponent', require('./components/CarComponent.vue').default);
Vue.component('keyboard2component', require('./components/Keyboard2Component.vue').default);
Vue.component('chat-component', require('./components/ChatComponent.vue').default);
Vue.component('chat-config-component', require('./components/ChatConfigComponent.vue').default);
Vue.component('answer-component', require('./components/AnswerComponent.vue').default);

/** Sweet Alert **/
// main.js
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);


//import vue 360
import VueThreeSixty from 'vue-360'
import 'vue-360/dist/css/style.css'

Vue.use(VueThreeSixty)


//config for keyboard
Vue.config.productionTip = false;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    delimiters: ['{%', '%}'],
    data(){
        return{
            consola: true
        }
    }
}).$mount("#app");