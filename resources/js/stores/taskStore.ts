import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import api from '@/lib/axios';

export interface Task {
    id: number;
    title: string;
    description: string | null;
    status: 'pending' | 'in_progress' | 'completed';
    priority: 'low' | 'medium' | 'high';
    user_id: number;
    user_name: string | null;
    due_date: string | null;
    created_at: string;
    updated_at: string;
}

export interface TaskFilters {
    status?: string;
    priority?: string;
    per_page?: number;
}

export const useTaskStore = defineStore('tasks', () => {
    // State
    const tasks = ref<Task[]>([]);
    const loading = ref(false);
    const error = ref<string | null>(null);
    const pagination = ref({
        current_page: 1,
        last_page: 1,
        per_page: 15,
        total: 0,
    });

    // Actions
    const fetchTasks = async (filters: TaskFilters = {}) => {
        loading.value = true;
        error.value = null;

        try {
            const response = await api.get('/tasks', { params: filters });
            tasks.value = response.data.data;
            pagination.value = {
                current_page: response.data.current_page,
                last_page: response.data.last_page,
                per_page: response.data.per_page,
                total: response.data.total,
            };
        } catch (err: any) {
            error.value = err.response?.data?.message || 'Failed to fetch tasks';
            console.error('Error fetching tasks:', err);
        } finally {
            loading.value = false;
        }
    };

    return {
        // State
        tasks,
        loading,
        error,
        pagination,

        // Actions
        fetchTasks
    };
});
