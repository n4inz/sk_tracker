<template>
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="border-2 w-1/2 mx-auto px-6 py-12 lg:px-8 rounded-xl shadow-md">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm ">
        <img class="mx-auto h-24 w-auto" src="/umpar.png" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm ">
        <form class="space-y-6"  @submit.prevent="submitLogin">
          <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
              <input v-model="form.email" @input="clearErrors('email')" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <div v-if="form.errors.email" v-text="form.errors.email" class="text-xs text-red-500 mt-2"></div>
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
              <!-- <div class="text-sm">
                <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
              </div> -->
            </div>
            <div class="mt-2">
              <input v-model="form.password" @input="clearErrors('password')" type="password" autocomplete="current-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              <div v-if="form.errors.password" v-text="form.errors.password" class="text-xs text-red-500 mt-2"></div>
            </div>
            <Link class="float-right mt-2 mb-5 font-semibold leading-6 text-indigo-600 hover:text-indigo-500" href="/register">Sign up</Link>

            <!-- <span class="float-right mt-2 mb-5 text-indigo-600">Sign up</span> -->
          </div>

          <div>
            <button :disabled="form.processing" type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
          </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
          Not a member?
          <a href="#" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Start a 14 day free trial</a>
        </p>
      </div>

    </div>
  </div>
</template>

<script>
    import { Link } from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';

    export default {
      components: {
          Link
      },

      setup(){
        const form = useForm({
            email: '',
            password: '',
        });

        const submitLogin = () => {
          form.post('/login-store');
        };

        const clearErrors = (field) => {
        form.clearErrors(field)
        };
        
        return {
          form,
          submitLogin,
          clearErrors
        };
      }



    }

</script>