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
  axios.post('/logout') 
    .then(response => {
      window.location.href = '/';  
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
    <div class="bg-black">
         <!-- Header Section with Logo and Buttons -->
    <div class="flex justify-between items-center py-4 px-6">
      <img src="/assets/logo.png" alt="Logo" class="h-10" /> <!-- Replace with your logo -->
      
      <div class="flex space-x-4">
    <button @click="logout" class="px-4 bg-red-500 text-white rounded-md">
      Logout
    </button>
    <div  class="flex space-x-4">
      <a href="/about" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 transition rounded-lg text-white font-semibold">
        About
      </a>
    </div>
      </div>
    </div>

    <!-- Main Content Section -->
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-black overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <!-- Add New Task Form -->
            <div class="mb-6">
              <input v-model="newTaskTitle" type="text" placeholder="Task Title" class="border p-2 rounded-lg w-full mb-2" />
              <textarea v-model="newTaskDescription" placeholder="Task Description" class="border p-2 rounded-lg w-full mb-2"></textarea>
              <button @click="addTask" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Todo</button>
            </div>



 <div v-if="tasks.length > 0" class="flex flex-wrap gap-4 justify-center">
  <!-- Loop through each task to create a card -->
  <div v-for="(task, index) in tasks" 
       :key="task.id" 
       :style="{ backgroundColor: getColorForTask(task.id) }"  
       class="shadow-md h-auto min-h-[150px] border border-gray-300 rounded-lg min-w-[250px] max-w-[250px] w-full sm:w-[250px] flex-grow">
    
    <!-- Card content with dynamic height based on content -->
    <div class="relative flex flex-col p-4 shadow-md h-auto min-h-[150px] min-w-[250px] max-w-[250px] border rounded-lg">
      
      <!-- Checkbox in the top-right corner -->
      <input 
        type="checkbox" 
        v-model="task.completed" 
        @change="toggleComplete(task.id)" 
        class="absolute top-2 right-2"
      />
      
      <!-- Title (No Line-through) -->
      <div class="font-bold mb-2">
        {{ task.title }}
      </div>

      <!-- Description (Line-through if completed) -->
      <div :class="{ 'line-through': task.completed }" class="mb-2 w-full break-words">
        {{ task.description }}
      </div>

      <!-- Delete Button -->
      <button @click="deleteTask(task.id)" class="bg-red-500 text-white px-4 py-2 rounded-md">
        Delete
      </button>
    </div>
  </div>
</div>
            <!-- No tasks message -->
            <div v-else class="text-center text-white">
              <p>No tasks available. Add a new task!</p>
            </div>
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
