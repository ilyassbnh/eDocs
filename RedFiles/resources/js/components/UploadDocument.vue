<template>
    <div>
      <h2>Upload Document</h2>
      <form @submit.prevent="uploadDocument">
        <div>
          <label for="title">Title:</label>
          <input v-model="form.title" type="text" required />
        </div>
  
        <div>
          <label for="content">Content:</label>
          <textarea v-model="form.content" required></textarea>
        </div>
  
        <div>
          <label for="category">Category:</label>
          <select v-model="form.category_id" required>
            <option v-for="category in categories" :key="category.id" :value="category.id">
              {{ category.name }}
            </option>
          </select>
        </div>
  
        <div>
          <label for="file">Document File:</label>
          <input type="file" @change="handleFileUpload" />
        </div>
  
        <button type="submit">Upload</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        form: {
          title: '',
          content: '',
          category_id: '',
          file: null, // File object
        },
        categories: [], // Array to store categories from the API
      };
    },
    methods: {
      handleFileUpload(event) {
        this.form.file = event.target.files[0];
      },
      uploadDocument() {
        const formData = new FormData();
        formData.append('title', this.form.title);
        formData.append('content', this.form.content);
        formData.append('category_id', this.form.category_id);
        formData.append('file', this.form.file); // Append the file
        console.log([...formData]);
        // Send the request
        axios.post('/api/documents', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then(response => {
          console.log(response.data);
          // Handle successful upload
        })
        .catch(error => {
          console.error('Error uploading document:', error);
        });
      },
      fetchCategories() {
        axios.get('/api/categories')
          .then(response => {
            this.categories = response.data; // Assign the fetched categories to the array
          })
          .catch(error => {
            console.error('Error fetching categories:', error);
          });
      },
    },
    mounted() {
      // Fetch categories when the component is mounted
      this.fetchCategories();
    }
  };
  </script>
  