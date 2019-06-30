
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./bootstrap-switch');
require('./bootstrap-datetimepicker');
require('./paper_kit');
require('./assessment');
import _ from 'lodash';
import map from './map';


window.Vue = require('vue');

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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });

import { textarea } from './textarea'
import { check_errors } from './check-errors'
import { upload_ad_attachment } from './upload-ad-attachment'
import { upload_post_attachment } from './upload-post-attachment'
import { upload_service_attachment } from './upload-service-attachment'
import { register_container } from './register-container'
import { has_messages } from './flash-messages'
import { upload_gym_images } from './upload-gym-images'
import { upload_gym_logo } from './upload-gym-logo'
import { star_ratings } from './ratings'
import { users } from './users'
import { upload_profile_picture } from './upload-profile-picture'
import { advertisements } from './advertisements'

$(document).ready(function() {
    check_errors()
    textarea()
    $(".modal").on('shown.bs.modal', function() {
        textarea($(this))
    });
    upload_ad_attachment()
    upload_post_attachment()
    upload_service_attachment()
    register_container()
    has_messages()
    upload_gym_images()
    upload_gym_logo()
    star_ratings()
    users()
    upload_profile_picture()
    advertisements()
})
