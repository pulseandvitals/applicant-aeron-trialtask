<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Success from "@/Components/Alert/Success.vue";

defineProps({
    records: Array,
    counts: Array,
});
let form = useForm({});
let deleteUser = (record) => {
    form.delete(route("user-records.destroy", { record: record }), {
        onBefore: () => confirm("Do you want to delete this user?"),
        preserveScroll: true,
    });
};
</script>
<template>
    <Head title="Records" />

    <AuthenticatedLayout>
        <Success />
        <div class="py-12">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="p-6 w-full">
                        <div class="flex justify-end mb-2">
                            <Link
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >
                                Create User
                            </Link>
                        </div>

                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-gray-50 active:bg-gray-100 mb-2"
                            v-for="record in records.data"
                            :key="record.id"
                        >
                            <div
                                class="px-6 py-4 border-b flex justify-between items-center"
                            >
                                <div class="text-gray-900 w-96">
                                    {{ record.name }}
                                    <div class="text-xs text-gray-400">
                                        {{ record.email }}
                                    </div>
                                </div>

                                <div
                                    class="text-xs text-gray-400"
                                    :class="[
                                        record.is_admin
                                            ? 'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300'
                                            : 'bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-700 dark:text-gray-300',
                                    ]"
                                >
                                    {{ record.is_admin ? "Admin" : "User" }}
                                </div>

                                <div class="text-xs text-gray-400">
                                    {{ record.contact_no }}
                                </div>

                                <div class="text-xs text-gray-400">
                                    {{ record.created_at }}
                                </div>

                                <div class="text-gray-900 text-sm">
                                    <Link
                                        class="font-medium text-gray-300 mr-2"
                                        :href="
                                            route('user-records.show', record)
                                        "
                                        >View</Link
                                    >
                                    <Link
                                        class="font-medium text-gray-300 mr-2"
                                        :href="
                                            route('user-records.edit', record)
                                        "
                                        >Edit</Link
                                    >
                                    <button
                                        class="font-xs text-gray-300 mr-2"
                                        @click="deleteUser(record)"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-gray-50 active:bg-gray-100 mb-2"
                            v-if="counts <= 0"
                        >
                            <div
                                class="px-6 py-4 border-b flex justify-between items-center"
                            >
                                Empty Users yet.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
