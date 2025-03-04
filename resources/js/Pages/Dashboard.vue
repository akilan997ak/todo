<script setup>
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';

// Define refs for tasks and form inputs
const tasks = ref([]);
const newTaskTitle = ref('');
const newTaskDescription = ref('');

// Function to fetch tasks from the server
const fetchTasks = () => {
  axios.get('/tasks')
    .then(response => {
      console.log('Response:', response.data);
      if (Array.isArray(response.data)) {
        tasks.value = response.data.filter(task => task.title && task.description);
       // alert('Tasks fetched successfully!');
      } else {
      //  alert('Fetched data is not an array. Here is the data: ' + JSON.stringify(response.data, null, 2));
      }
    })
    .catch(error => {
      console.error('Error fetching tasks:', error);
      if (error.response) {
      //  alert('Error fetching tasks: ' + error.response.data);
      } else if (error.request) {
      //  alert('No response received from the server.');
      } else {
       // alert('Error setting up request: ' + error.message);
      }
    }
  );
};

// Fetch tasks when component is mounted
onMounted(() => {
  fetchTasks();
});

// Function to delete a task
const deleteTask = (id) => {
  axios.delete(`/tasks/${id}`)
    .then((response) => {
      if (response.status === 200 || response.status === 204) {
        tasks.value = tasks.value.filter(task => task.id !== id);
      //  alert('Task deleted successfully!');
      } else {
      //  alert('Failed to delete task. Server returned an unexpected status.');
      }
    })
    .catch((error) => {
      console.error('Error deleting task:', error);
      if (error.response) {
     //   alert('Error deleting task: ' + (error.response.data.message || 'Unknown error.'));
      } else {
      //  alert('Network error or task deletion failed.');
      }
    });
};


// Function to mark task as completed
const toggleComplete = (id) => {
  axios.patch(`/tasks/${id}/complete`).then(() => {
    const task = tasks.value.find(task => task.id === id);
    if (task) {
      task.completed = !task.completed;
    }
   // alert('Task status updated!');
  }).catch(error => {
    console.error('Error toggling task completion:', error);
  });
};

// Function to add a new task
const addTask = () => {
  if (newTaskTitle.value.trim() === '' || newTaskDescription.value.trim() === '') {
   // alert('Please fill out both title and description.');
    return;
  }

  // Make the POST request to add a new task
  axios.post('/tasks', {
    title: newTaskTitle.value,
    description: newTaskDescription.value,
    completed: 0,  // New tasks start with 'completed' status as false
  })
  .then((response) => {
    if (response.data && response.data.id) {
      tasks.value.unshift({
        id: response.data.id,
        title: newTaskTitle.value,
        description: newTaskDescription.value,
        completed: false,  // New task is not completed
      });
    //  alert('Task added successfully!');
    }
    newTaskTitle.value = '';  // Clear title input
    newTaskDescription.value = '';  // Clear description input
  })
  .catch((error) => {
   // alert('An error occurred while adding the task');
    console.error('Error adding task:', error);
  });
};

// Logout function to send POST request to the backend
const logout = () => {
  axios.post('/logout')  // Sending POST request to logout route
    .then(response => {
      // Redirect to home or login page after logout
      window.location.href = '/';  // or any redirect URL you prefer
    })
    .catch(error => {
      console.error('Error logging out:', error);
    });
};

// Function to generate a consistent color based on task ID
const getColorForTask = (taskId) => {
  const colors = ['#FFFAF0', '#E0FFFF', '#FFF0F5', '#F0E68C', '#E6E6FA', '#F5FFFA', '#F0F8FF'];
  return colors[taskId % colors.length];  // Generate a color based on task ID
};

</script>

<template>
  <Head title="Dashboard" />
  
  <AuthenticatedLayout>
    <!-- Header Section with Logo and Buttons -->
    <div class="flex justify-between items-center py-4 px-6">
      <img src="/assets/logo.png" alt="Logo" class="h-10" /> <!-- Replace with your logo -->
      
      <div class="flex space-x-4">
        <!-- <button @click="goToProfile" class="px-4 py-2 bg-green-500 text-black rounded-md">Profile</button> -->
        <!-- <button @click="logout" class="px-4 py-2 bg-red-300 text-black rounded-md">Logout</button> -->
        <button @click="logout" class="px-4 py-2 bg-red-500 text-white rounded-md">
      Logout
    </button>
      </div>
    </div>

    <!-- Main Content Section -->
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <!-- Add New Task Form -->
            <div class="mb-6">
              <input v-model="newTaskTitle" type="text" placeholder="Task Title" class="border p-2 rounded-lg w-full mb-2" />
              <textarea v-model="newTaskDescription" placeholder="Task Description" class="border p-2 rounded-lg w-full mb-2"></textarea>
              <button @click="addTask" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Todo</button>
            </div>

            <!-- Task List -->
            <div v-if="tasks.length > 0" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
  <div v-for="task in tasks" :key="task.id" :style="{ backgroundColor: getColorForTask(task.id) }" class="relative flex flex-col justify-between p-4 rounded-lg shadow-md">
    
    <!-- Checkbox in the top-right corner -->
    <input 
      type="checkbox" 
      v-model="task.completed" 
      @change="toggleComplete(task.id)" 
      class="absolute top-2 right-2"
    />
    
    <!-- Title (No Line-through) -->
    <div  class="font-bold mb-2">
      {{ task.title }}
    </div>

    <!-- Description (Line-through if completed) -->
    <div :class="{ 'line-through': task.completed }" class="mb-2">
      {{ task.description }}
    </div>

    <!-- Delete Button -->
    <button @click="deleteTask(task.id)" class="bg-red-500 text-white px-4 py-2 rounded-md self-start">
      Delete
    </button>
  </div>
</div>


            <!-- No tasks message -->
            <div v-else class="text-center text-gray-500">
              <p>No tasks available. Add a new task!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>




<style scoped>
.line-through {
  text-decoration: line-through;
}
</style>
