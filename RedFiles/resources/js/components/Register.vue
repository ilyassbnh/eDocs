<template>
    <div>
        <h1>Register</h1>
        <form @submit.prevent="handleRegister">
            <div>
                <label for="name">Name:</label>
                <input type="text" v-model="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" v-model="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" v-model="password" required>
            </div>
            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" v-model="password_confirmation" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            errorMessage: '',
        };
    },
    methods: {
        async handleRegister() {
            try {
                this.errorMessage = ''; // Clear previous errors
                const response = await axios.post('/api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                });

                console.log('Registration successful:', response.data);
                // Redirect to login page after successful registration
                this.$router.push('/login');
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    // Handle validation errors
                    this.errorMessage = Object.values(error.response.data.errors).flat().join(', ');
                } else {
                    this.errorMessage = 'Registration failed. Please try again.';
                }
            }
        },
    },
};
</script>
