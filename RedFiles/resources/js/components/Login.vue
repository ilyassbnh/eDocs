<template>
  <div>
      <h1>Login</h1>
      <form @submit.prevent="handleLogin">
          <div>
              <label for="email">Email:</label>
              <input type="email" v-model="email" required>
          </div>
          <div>
              <label for="password">Password:</label>
              <input type="password" v-model="password" required>
          </div>
          <button type="submit">Login</button>
      </form>
      <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
      return {
          email: '',
          password: '',
          errorMessage: '', // For displaying errors
      };
  },
  methods: {
      async handleLogin() {
          try {
              this.errorMessage = ''; // Clear previous errors
              const response = await axios.post('/api/login', {
                  email: this.email,
                  password: this.password,
              });

              console.log('Login successful:', response.data);
              // Save the token or handle login state as needed
              localStorage.setItem('token', response.data.token);

              // Redirect to the home page after successful login
              this.$router.push('/home');
          } catch (error) {
              if (error.response && error.response.data.message) {
                  // Handle authentication error
                  this.errorMessage = error.response.data.message;
              } else {
                  this.errorMessage = 'Login failed. Please try again.';
              }
          }
      },
  },
};
</script>

<style scoped>
.error {
  color: red;
  margin-top: 10px;
}
</style>
