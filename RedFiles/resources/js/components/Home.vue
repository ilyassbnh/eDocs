<template>
  <div>
    <h1>Welcome to Your Vue Application!</h1>
    <button @click="logout">Logout</button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Home',
  methods: {
    async logout() {
      try {
        await axios.post('/api/logout', {}, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          }
        });
        
        // Clear the token from local storage
        localStorage.removeItem('token');

        // Redirect to the login page after logout
        this.$router.push({ name: 'login' });
      } catch (error) {
        console.error('Logout error:', error);
      }
    }
  }
}
</script>
