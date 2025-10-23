<template>
  <Head title="Tasks" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <TasksTable
              @add-task="openAddModal"
              @edit-task="openEditModal"
            />
          </div>
        </div>
      </div>
    </div>

    <!-- Task Modal -->
    <TaskModal
      :is-open="isModalOpen"
      :task="selectedTask"
      @close="closeModal"
      @success="handleTaskSuccess"
    />
  </AppLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import TasksTable from '@/components/TasksTable.vue';
import TaskModal from '@/components/TaskModal.vue';
import { useTaskStore, type Task } from '@/stores/taskStore';
import type { BreadcrumbItemType } from '@/types';

// Store
const taskStore = useTaskStore();

// Breadcrumbs
const breadcrumbs: BreadcrumbItemType[] = [
    { label: 'Dashboard', href: '/dashboard' },
    { label: 'Tasks', href: '/tasks' },
];

// State
const isModalOpen = ref(false);
const selectedTask = ref<Task | null>(null);

// Methods
const openAddModal = () => {
  selectedTask.value = null;
  isModalOpen.value = true;
};

const openEditModal = (task: Task) => {
  selectedTask.value = task;
  isModalOpen.value = true;
};

const closeModal = () => {
  isModalOpen.value = false;
  selectedTask.value = null;
};

const handleTaskSuccess = () => {
  // Refresh the tasks list
  taskStore.fetchTasks();
};
</script>
