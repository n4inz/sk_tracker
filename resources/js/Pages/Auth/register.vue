<template>
   <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign up account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" @submit.prevent="submitRegister">
        <div class="flex items-center space-x-2">
            <div class="h-20">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                  <input @input="clearErrors('name')" v-model="form.name" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  <div v-if="form.errors.name" v-text="form.errors.name" class="text-xs text-red-500 mt-2"></div>
                </div>
            </div>
            <div class="h-20">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                <div class="mt-2">
                  <input @input="clearErrors('username')" name="username" v-model="form.username" type="text"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                  <div v-if="form.errors.username" v-text="form.errors.username" class="text-xs text-red-500 mt-2"></div>
                </div>
            </div>

        </div>
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
              <input @input="clearErrors('email')" name="email" type="email" v-model="form.email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <div v-if="form.errors.email" v-text="form.errors.email" class="text-xs text-red-500 mt-2"></div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
        
            </div>
            <div class="mt-2">
              <input @input="clearErrors('password')" name="password" v-model="form.password" type="password" autocomplete="current-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <div v-if="form.errors.password" v-text="form.errors.password" class="text-xs text-red-500 mt-2"></div>
            </div>
        </div>
        <div class="mb-2">
         <Link class="float-right mb-2 font-semibold leading-6 text-indigo-600 hover:text-indigo-500" href="/">Login</Link>

        </div>

        <div>
            <button :disabled="form.processing" type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign up</button>
        </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
      Not a member?
      <a href="#" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Start a 14 day free trial</a>
    </p>
  </div>
</div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

import { useForm } from '@inertiajs/vue3'

export default {
  components: {
    Link
  },

  setup(){
    const form = useForm({
        name: '',
        username: '',
        email: '',
        password: '',
    });

    const submitRegister = () => {
      form.post('/register-store');
    };

    const clearErrors = (field) => {
     form.clearErrors(field)
    };
    
    return {
      form,
      submitRegister,
      clearErrors
    };
  }

}

</script>
