<template>
  <div class="max-w-sm mx-auto my-10 p-6 bg-white border border-gray-200 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Sign Up</h2>
    <form @submit.prevent="submitSignup">
      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" id="name" v-model="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
      </div>
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" v-model="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
      </div>
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" v-model="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
      </div>
      <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">Sign Up</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      email: '',
      password: ''
    };
  },
  methods: {
    async submitSignup() {
      const response = await axios.post('/register', {
        name: this.name,
        email: this.email,
        password: this.password,
      });

      if (response.data.success) {
        // Handle successful signup
        alert("Account created successfully!");
      } else {
        // Handle signup failure
        alert("Error creating account!");
      }
    }
  }
};
</script>
