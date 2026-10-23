<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

// useForm membuat sebuah objek form yang otomatis mengelola nilai input dan pesan error
const form = useForm({
    kode_buku: '',
    judul: '',
    pengarang: '',
    penerbit: '',
    tahun: '',
    stok: 0,
});

// Dipanggil ketika tombol submit diklik
function submit() {
    // Mengirim data form ke route books.store, yaitu method store() pada BookController
    form.post(route('books.store'));
}
</script>

<template>
    <AuthenticatedLayout>
        <h1>Tambah Buku</h1>
        <form @submit.prevent="submit">
            <!-- @submit.prevent mencegah form reload halaman, lalu menjalankan function submit() -->
            
            <label>Kode Buku</label>
            <input v-model="form.kode_buku" type="text">
            <!-- Menampilkan pesan error dari validasi Laravel jika ada -->
            <span v-if="form.errors.kode_buku" style="color: red;">{{ form.errors.kode_buku }}</span>

            <br>
            <label>Judul</label>
            <input v-model="form.judul" type="text">
            <span v-if="form.errors.judul" style="color: red;">{{ form.errors.judul }}</span>

            <br>
            <label>Pengarang</label>
            <input v-model="form.pengarang" type="text">
            <span v-if="form.errors.pengarang" style="color: red;">{{ form.errors.pengarang }}</span>

            <br>
            <label>Penerbit</label>
            <input v-model="form.penerbit" type="text">

            <br>
            <label>Tahun</label>
            <input v-model="form.tahun" type="text">

            <br>
            <label>Stok</label>
            <input v-model="form.stok" type="number">

            <br><br>
            <button type="submit">Simpan</button>
        </form>
    </AuthenticatedLayout>
</template>