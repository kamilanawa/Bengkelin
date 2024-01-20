## Perubahan File (kode)
1. File `app\Http\Controllers\ServiceController.php` pada method `index`.
    mengubah wuery untuk search bengkel berdasarkan nama dan keyword dengan LIKE sehingga dapat menampilkan data bengkel yang memiliki nama yang mirip dengan keyword yang di cari.
    Menambahkan kode untuk menghitung rata-rata rating dari tiap bengkel.

2. file `resources\views\user\detailbengkelpage.blade.php` menambahkan tampilan untuk menampilkan testimonial dari bengkel yang dilihat dan menampilkan pagination untuk testimonal.

3. file baru pada `resources\views\mitra\bengkel\tambahgambar.blade.php` digunakan untuk menambahkan gambar bengkel.

4. file baru `database\migrations\2024_01_17_092247_add_gambar_to_bookings_table.php` digunakan untuk menambahkan kolom `gambar` pada tabel `bookings`.

5. file `resources\views\mitra\bengkel\transaksi.blade.php` menambahkan view untuk sweatalert sehingga dapat menampilkan pesan ketika booking diubah statusnya menjadi selesai dan menambahkan gambar.

6. file `app\Http\Controllers\TransaksiController.php` pada method `updatetransaksi` menambahkan kondisi ketika status booking diubah menjadi selesai maka akan menampilkan halaman tambah gambar terlebih dahulu alih-alih langsung mengubah status.

7. file `app\Http\Controllers\TransaksiController.php` menambahkan method `tambahgambar` untuk menampilkan view tambah gambar. dan method `simpantambahgambar` untuk menyimpan gambar yang diupload.

8. file `database\migrations\2024_01_16_221603_add_rating_to_bookings_table.php` digunakan untuk menambahkan kolom `rating` dan `review` pada tabel `bookings`.

9. file `app\Models\Booking.php` menambahkan filable `rating`,`review` dan `gambar` pada model `Booking`.

10. file `routes\web.php` menambahkan route untuk menampilkan view tambah gambar dan menyimpan gambar dan Menambahkan route baru untuk memberikan rating kepada hasil booking

11. `resources\views\user\servicepage.blade.php` mengubah kode pada tag form.

12. `resources\views\mitra\bengkel\edittransaksi.blade.php` menambahkan kode untuk menampilkan gambar jika ada.

13. `app\Http\Controllers\BookingController.php` menambahkan method baru `rating` yang digunakan untuk memberikan rating dan review pada bengkel saat selesai booking.

14. `resources\views\user\pemesananpage.blade.php` menambahkan kode untuk menampilkan pesan bahwa layanan bengkel belum tersedia jika masih kosong.