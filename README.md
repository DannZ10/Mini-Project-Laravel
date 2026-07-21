# 🚀 LMS REST API - Mini Project Fullstack Web Development

Sebuah RESTful API tangguh yang dibangun menggunakan **Laravel 11** untuk sistem Learning Management System (LMS). Proyek ini merupakan tugas implementasi dari pengembangan *backend* yang dirancang dengan standar *production-level*, mencakup fitur CRUD komprehensif, autentikasi, autorisasi, optimalisasi *database*, serta otomatisasi pengujian API.

---

## 🌐 Live Deployment
- **Base API URL**: [https://mini-project-laravel-production.up.railway.app/api](https://mini-project-laravel-production.up.railway.app/api)
- **Status**: ✅ Online (Deployed on Railway.app)
- **Database**: MySQL 8.0 (Railway Internal)

---

## 📌 Tahap 1: Day 34 - Mini Project REST API
Fase ini berfokus pada pembangunan arsitektur dasar *database* dan operasi CRUD dengan struktur respons yang konsisten.

### ✨ Fitur Utama
- **UUID Primary Keys:** Mencegah ID tertebak (Insecure Direct Object Reference).
- **Soft Deletes:** Data yang dihapus tidak benar-benar hilang dari *database* (Aman untuk *Audit Trail*).
- **Standardized JSON Response:** Menggunakan Trait khusus untuk memastikan setiap respons (Sukses/Error/Validasi) memiliki struktur JSON yang seragam.
- **Advanced Querying:**
  - 🔍 **Search:** Pencarian kelas berdasarkan judul.
  - 🎛️ **Filter:** Menyaring kelas berdasarkan level kesulitan (beginner, intermediate, advanced) dan kategori ID.
  - 📊 **Sorting:** Mengurutkan kelas berdasarkan harga, rating, durasi, dan jumlah pendaftar secara Ascending/Descending.
- **Dynamic Rating Classification:** Sistem otomatis memberikan predikat kelas seperti *Top Rated*, *Recommended*, atau *Regular* menggunakan Eloquent Accessor.

---

## 🔒 Tahap 2: Day 38 - Authentication & Testing API
Fase ini berfokus pada pengamanan *endpoint*, pembatasan hak akses, optimasi performa, dan pengujian menyeluruh (End-to-End Testing) menggunakan Postman.

### ✨ Fitur Utama
- **Token-Based Authentication:** Menggunakan **Laravel Sanctum** untuk menerbitkan dan mencabut token otorisasi secara aman.
- **Role-Based Authorization:** Validasi ketat di mana **hanya pemilik kelas (instructor)** atau admin yang memiliki hak untuk melakukan *update* atau *delete* pada kursus mereka sendiri.
- **Performance Optimization (Caching):** Menerapkan `Cache::remember` pada *endpoint* publik (daftar kursus) untuk meminimalkan beban *database* saat trafik tinggi.
- **Complex Database Query:** Menggunakan Query Builder dengan fungsi agregasi (`JOIN`, `COUNT`, `AVG`) untuk menghasilkan laporan statistik platform secara efisien.
- **API Test Automation:** Koleksi Postman yang dilengkapi dengan *script* otomatis untuk menangkap token dan memvalidasi setiap *HTTP status code* (200, 201, 401, 403, 404, 422).

---

## 🛠️ Tech Stack
- **Framework:** Laravel 11 (PHP)
- **Database:** MySQL
- **Testing & Automation:** Postman

---

## 📦 Struktur Endpoint API

### 🔐 Auth
| Method | Endpoint | Keterangan |
| :--- | :--- | :--- |
| `POST` | `/api/register` | Mendaftarkan akun baru (Student/Instructor) |
| `POST` | `/api/login` | Mendapatkan Bearer Token |
| `POST` | `/api/logout` | Mencabut token (Wajib Token) |

### 📚 Course Categories (`/api/categories`)
| Method | Endpoint | Keterangan |
| :--- | :--- | :--- |
| `GET` | `/api/categories` | (Public) Menampilkan semua kategori |
| `GET` | `/api/categories/{id}` | (Public) Menampilkan detail kategori |
| `POST` | `/api/categories` | (Protected) Menambahkan kategori baru |
| `PUT` | `/api/categories/{id}` | (Protected) Mengubah data kategori |
| `DELETE` | `/api/categories/{id}` | (Protected) Menghapus kategori (dilengkapi proteksi relasi) |

### 🎓 Courses (`/api/courses`)
| Method | Endpoint | Keterangan |
| :--- | :--- | :--- |
| `GET` | `/api/courses` | (Public + Cached) Menampilkan semua kelas (+ fitur search, filter, sort) |
| `GET` | `/api/courses/stats` | (Public) Menampilkan statistik agregat performa platform |
| `GET` | `/api/courses/{id}` | (Public) Menampilkan detail kelas beserta kategori dan instruktur |
| `POST` | `/api/courses` | (Protected) Menambahkan kelas baru (Instructor ID otomatis disematkan) |
| `PUT` | `/api/courses/{id}` | (Protected + Authorization) Mengubah data kelas |
| `DELETE` | `/api/courses/{id}` | (Protected + Authorization) Menghapus kelas |

---
*Created by Muhammad Hamdan Yusuf - Dibimbing Fullstack Web Development Batch 11*
