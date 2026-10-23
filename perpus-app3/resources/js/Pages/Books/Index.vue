<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    books: Object,
    search: String, // Menerima kata kunci pencarian terakhir dari controller
});

// Menyimpan nilai ketikan pada kotak pencarian
const keyword = ref(props.search);

// Fungsi untuk menangani pencarian saat tombol Enter ditekan
function cari() {
    router.get('/books', { search: keyword.value });
}

// Fungsi untuk konfirmasi dan menghapus data buku
function hapus(id) {
    if (confirm('Yakin ingin menghapus buku ini?')) {
        router.delete(route('books.destroy', id));
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <h1>Data Buku</h1>

        <!-- Flash Message Sukses -->
        <div v-if="$page.props.flash.success" style="color: green; margin-bottom: 10px;">
            {{ $page.props.flash.success }}
        </div>

        <Link href="/books/create">+ Tambah Buku</Link>

        <!-- Kotak Pencarian -->
        <div style="margin: 15px 0;">
            <input
                v-model="keyword"
                @keyup.enter="cari"
                type="text"
                placeholder="Cari judul atau pengarang..."
                style="padding: 5px; width: 250px;"
            >
        </div>

        <table border="1" cellpadding="10" style="width: 100%;">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in books.data" :key="book.id">
                    <td>{{ book.kode_buku }}</td>
                    <td>{{ book.judul }}</td>
                    <td>{{ book.pengarang }}</td>
                    <td>{{ book.stok }}</td>
                    <td>
                        <!-- Tautan menuju form Edit -->
                        <Link :href="`/books/${book.id}/edit`">Edit</Link> | 
                        <!-- Tombol Hapus -->
                        <button @click="hapus(book.id)">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </AuthenticatedLayout>
</template>