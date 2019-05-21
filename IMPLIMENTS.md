##Implements in Theme:
required axiox
````
npm i
npm install vue-js-modal --save
````

0. Publish config and Vue Component
````
php artisan vendor:publish
````
+ laravelasterisk-config
+ laravelasterisk-vue-component
    

1. Add in menu:
````
<li class="m-menu__item " aria-haspopup="true">
    <a  href="{{ route('taskmanagerView') }}" class="m-menu__link">
        <span class="m-menu__item-here"></span>
        {!! config('LaravelAsterisk.butIcon')  !!}
        <span class="m-menu__link-text">
            {{ config('LaravelAsterisk.butTitle') }}
        </span>
    </a>
</li>
````

2. Include Vue component in app.js
````
    Vue.component('taskmanager', require('./components/LaravelAsterisk.vue').default);
````

3. Include your app.js file in layouts & add id="app" in main div
````
<script src="{{ asset('js/app.js') }}" defer></script>
````
&
````
<body>
    <div id="app">
    ...
    </div>
</body>
````

4. Run command
````
npm run prod
````

###If have errors in console try delete in app.js this line
````
require('./bootstrap');
````