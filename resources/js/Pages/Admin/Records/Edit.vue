<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Success from "@/Components/Alert/Success.vue";
import TextInput from "@/Components/TextInput.vue";
import { nextTick, ref } from "vue";

const props = defineProps({
    record: Object,
});
const form = useForm({
    name: props.record.data.name,
    email: props.record.data.email,
    contact_no: props.record.data.contact_no,
});
</script>

<template>
    <Head :title="record.data.name" />

    <AuthenticatedLayout>
        <Success />
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 w-full">
                        <form
                            class="space-y-6"
                            @submit.prevent="
                                form.put(
                                    route('user-records.update', record.data)
                                )
                            "
                            enctype="multipart/form-data"
                        >
                            <div class="">
                                <span class="text-gray-600 font-bold">
                                    User Information
                                </span>
                            </div>
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>

                            <div>
                                <InputLabel for="email" value="Email" />

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="contact_no"
                                    value="Contact No."
                                />

                                <TextInput
                                    id="contact_no"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.contact_no"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.contact_no"
                                />
                            </div>

                            <div class="flex items-center gap-4 justify-end">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    >Update</PrimaryButton
                                >
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
