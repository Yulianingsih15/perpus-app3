<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router } from '@inertiajs/vue3';

// Menerima data books dari BookController
defineProps({
    books: Array,
});

// Fungsi untuk menghapus buku dengan konfirmasi
function destroy(id) {
    if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
        router.delete(route('books.destroy', id));
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Data Buku</h1>

            <!-- Tombol Tambah Buku -->
            <Link 
                :href="route('books.create')" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block"
            >
                + Tambah Buku
            </Link>

            <!-- Tabel Data Buku -->
            <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg overflow-hidden mt-4">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold text-sm">Kode</th>
                        <th class="text-left py-3 px-4 font-semibold text-sm">Judul</th>
                        <th class="text-left py-3 px-4 font-semibold text-sm">Pengarang</th>
                        <th class="text-left py-3 px-4 font-semibold text-sm">Stok</th>
                        <th class="text-center py-3 px-4 font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="book in books" :key="book.id" class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ book.kode_buku }}</td>
                        <td class="py-3 px-4">{{ book.judul }}</td>
                        <td class="py-3 px-4">{{ book.pengarang }}</td>
                        <td class="py-3 px-4">{{ book.stok }}</td>
                        <td class="py-3 px-4 text-center space-x-2">
                            <!-- Tombol Edit -->
                            <Link 
                                :href="route('books.edit', book.id)" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-3 rounded text-sm"
                            >
                                Edit
                            </Link>

                            <!-- Tombol Hapus -->
                            <button 
                                @click="destroy(book.id)" 
                                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded text-sm"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                    <tr v-if="books.length === 0">
                        <td colspan="5" class="text-center py-4 text-gray-500">
                            Belum ada data buku.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>