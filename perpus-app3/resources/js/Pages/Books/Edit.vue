<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    book: Object
});

const form = useForm({
    kode_buku: props.book.kode_buku,
    judul: props.book.judul,
    pengarang: props.book.pengarang,
    penerbit: props.book.penerbit,
    tahun: props.book.tahun,
    stok: props.book.stok,
});

function submit() {
    form.put(route('books.update', props.book.id));
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="p-6 max-w-lg mx-auto bg-white shadow-md rounded-lg mt-6">
            <h1 class="text-xl font-bold mb-4">Edit Buku</h1>
            <form @submit.prevent="submit" class="space-y-3">
                <div>
                    <label class="block font-semibold">Kode Buku</label>
                    <input v-model="form.kode_buku" type="text" class="w-full border rounded p-2">
                    <span v-if="form.errors.kode_buku" class="text-red-500 text-sm">{{ form.errors.kode_buku }}</span>
                </div>

                <div>
                    <label class="block font-semibold">Judul</label>
                    <input v-model="form.judul" type="text" class="w-full border rounded p-2">
                    <span v-if="form.errors.judul" class="text-red-500 text-sm">{{ form.errors.judul }}</span>
                </div>

                <div>
                    <label class="block font-semibold">Pengarang</label>
                    <input v-model="form.pengarang" type="text" class="w-full border rounded p-2">
                    <span v-if="form.errors.pengarang" class="text-red-500 text-sm">{{ form.errors.pengarang }}</span>
                </div>

                <div>
                    <label class="block font-semibold">Penerbit</label>
                    <input v-model="form.penerbit" type="text" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block font-semibold">Tahun</label>
                    <input v-model="form.tahun" type="text" class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block font-semibold">Stok</label>
                    <input v-model="form.stok" type="number" class="w-full border rounded p-2">
                </div>

                <div class="pt-2">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                        Update Buku
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>