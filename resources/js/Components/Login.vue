<template>
  <div class="max-w-sm mx-auto my-10 p-6 bg-white border border-gray-200 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Login</h2>
    <form @submit.prevent="submitLogin">
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" v-model="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
      </div>
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" v-model="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">Login</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    async submitLogin() {
      const response = await axios.post('/login', {
        email: this.email,
        password: this.password,
      });

      if (response.data.success) {
        // Handle successful login
        alert("Logged in successfully!");
      } else {
        // Handle login failure
        alert("Invalid credentials!");
      }
    }
  }
};
</script>
