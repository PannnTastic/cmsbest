# AGENTS.md - PT Berkah Sekawan Tangguh (BEST) CMS

## Tentang Proyek
Proyek ini adalah **CMS Admin Panel** untuk PT Berkah Sekawan Tangguh (BEST), dibangun menggunakan Filament v3. CMS ini mengelola data master yang ditampilkan oleh client-side website e-commerce (folder `best`).

## Tech Stack
- **Framework**: Laravel 11
- **Admin Panel**: Filament v3
- **Database**: MySQL (shared dengan client-side)
- **Storage**: `public` disk untuk upload gambar dan PDF

## Struktur Direktori Penting
```
app/Filament/Resources/
├── Blogs/
│   ├── BlogResource.php
│   ├── Pages/
│   │   ├── CreateBlog.php
│   │   ├── EditBlog.php
│   │   └── ListBlogs.php
│   ├── Schemas/BlogForm.php
│   └── Tables/BlogsTable.php
├── Categories/
│   ├── CategoryResource.php
│   ├── Pages/
│   ├── Schemas/CategoryForm.php
│   └── Tables/CategoriesTable.php
├── Products/
│   ├── ProductResource.php
│   ├── Pages/
│   ├── Schemas/ProductForm.php
│   └── Tables/ProductsTable.php
├── Carts/
│   └── CartResource.php
├── CartProducts/
│   └── CartProductResource.php
└── ...

app/Models/
├── Blog.php
├── Category.php
├── Product.php
├── Picture.php
├── Cart.php
├── CartProduct.php
├── Address.php        # Ditambahkan untuk integrasi client-side
└── User.php
```

## Database & Integrasi Client-Side
CMS ini menggunakan **database yang sama** dengan client-side (`best`):
- **DB_CONNECTION**: `mysql`
- **DB_DATABASE**: `best`
- **DB_HOST**: `127.0.0.1`

### Migration & Schema
**Schema database diatur oleh project `best` (client-side).** Folder `database/migrations` di CMS sengaja dikosongkan agar tidak terjadi konflik duplikat saat `php artisan migrate`. 

**Cara setup database:**
1. Jalankan migration dari project `best`:
   ```bash
   cd ../best && php artisan migrate:fresh
   ```
2. CMS (`cmsbest`) hanya perlu connect ke DB yang sudah jadi.

### Tabel yang Dikelola CMS
- `categories` - Kategori produk
- `products` - Data produk
- `pictures` - Gambar produk (relasi ke products)
- `blogs` - Artikel/blog dengan gambar dan PDF
- `users` - Data user (termasuk kolom `phone`)
- `carts` & `cart_products` - Keranjang belanja
- `addresses` - Alamat pengiriman user

### Catatan Integrasi
1. **Upload Gambar**: Semua upload gambar produk dan blog menggunakan `disk('public')`. Client-side mengaksesnya via symlink `public/storage/`.
2. **Path Gambar**: Di database disimpan sebagai path relatif (contoh: `products/nama-file.jpg`). Client-side menggunakan `asset('storage/' . $path_gambar)`.
3. **Kolom Penting**:
   - Category: `nama_kategori`
   - Product Picture: `path_gambar`
   - Blog: `judul_blog`, `gambar_blog`, `pdf_blog`
4. **Primary Keys Custom**:
   - `category_id` untuk categories
   - `product_id` untuk products
   - `blog_id` untuk blogs
   - `picture_id` untuk pictures
   - `cart_id` untuk carts
   - `cart_product_id` untuk cart_products
   - `address_id` untuk addresses
   - `user_id` untuk users

## Warna Brand
- **Primary Blue**: `#0F3075`
- **Accent Orange**: `#F97316`
- **Background**: `#F9FAFB`
- **Text Primary**: `#1E293B`

## Route Filament
- `/admin` - Login & Dashboard Admin Panel

## Catatan Development
1. Pastikan `APP_URL` di `.env` sesuai agar upload gambar tampil benar di client-side.
2. Jangan hapus migration `0001_01_01_000000_create_users_table.php` karena client-side bergantung pada schema users yang sama.
3. Jika menambah resource Filament baru, ikuti pola folder yang sudah ada: `Resources/{Plural}/{Resource}.php` dengan subfolder `Pages`, `Schemas`, dan `Tables`.
4. Semua file upload disimpan di `storage/app/public/` dan diakses client melalui symlink `public/storage`.
