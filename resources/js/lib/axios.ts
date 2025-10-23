import axios from 'axios';

// Create axios instance with base configuration
const api = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
    withCredentials: true, // Important for Laravel Sanctum session authentication
});

// Request interceptor to add CSRF token
api.interceptors.request.use(
    (config) => {
        // Get CSRF token from meta tag (Laravel provides this)
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (token) {
            config.headers['X-CSRF-TOKEN'] = token;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

// Response interceptor for error handling
api.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        // Handle authentication errors
        if (error.response?.status === 401) {
            // Redirect to login or handle unauthorized access
            // window.location.href = '/login';
        }

        // Handle validation errors
        if (error.response?.status === 422) {
            // You can handle validation errors here if needed
            console.error('Validation errors:', error.response.data.errors);
        }

        return Promise.reject(error);
    }
);

export default api;
