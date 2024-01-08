<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Success from "@/Components/Alert/Success.vue";

defineProps({
    record: Object,
});
let form = useForm({});
let deleteUser = (record) => {
    form.delete(route("user-records.destroy", record), {
        onBefore: () => confirm("Do you want to delete this user?"),
        preserveScroll: true,
    });
};
</script>
<template>
    <Head title="Job Offer" />

    <AuthenticatedLayout>
        <Success />
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="p-6 w-full">
                        <div class="flex justify-between mb-2 px-3">
                            <Link :href="route('user-records.index')">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"
                                    />
                                </svg>
                            </Link>
                            <button @click="deleteUser(record.data)">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 text-red-500"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                    />
                                </svg>
                            </button>
                        </div>
                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2 py-3 px-3"
                        >
                            <span
                                class="font-bold flex mb-3 text-3xl text-gray-700"
                            >
                                {{ record.data.name }}
                            </span>
                            <span class="text-lg text-gray-500">
                                {{ record.data.email }}
                            </span>
                            <div>
                                <span
                                    class="text-gray-400"
                                    :class="[
                                        record.data.is_admin
                                            ? 'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'
                                            : 'bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-700 dark:text-gray-300',
                                    ]"
                                >
                                    {{ record.is_admin ? "Admin" : "User" }}
                                </span>
                                <div>
                                    <span class="text-lg text-gray-500">
                                        {{ record.data.created_at }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
