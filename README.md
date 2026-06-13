# 🚀 LMS REST API - Mini Project Fullstack Web Development

Sebuah RESTful API tangguh yang dibangun menggunakan **Laravel 11** untuk sistem Learning Management System (LMS). Proyek ini merupakan tugas implementasi dari pengembangan *backend* yang mencakup fitur CRUD komprehensif, validasi data yang ketat, serta standardisasi respons JSON.

## ✨ Fitur Utama
Sistem ini telah dirancang dengan standar *production-level* yang memiliki fitur:
- **UUID Primary Keys:** Mencegah ID tertebak (Insecure Direct Object Reference).
- **Soft Deletes:** Data yang dihapus tidak benar-benar hilang dari *database* (Aman untuk *Audit Trail*).
- **Standardized JSON Response:** Menggunakan Trait khusus untuk memastikan setiap respons (Sukses/Error/Validasi) memiliki struktur yang seragam.
- **Advanced Querying (Bonus Feature):**
  - 🔍 **Search:** Pencarian kelas berdasarkan judul.
  - 🎛️ **Filter:** Menyaring kelas berdasarkan level kesulitan (beginner, intermediate, advanced) dan kategori.
  - 📊 **Sorting:** Mengurutkan kelas berdasarkan harga, rating, durasi, dll secara Ascending/Descending.
- **Dynamic Rating Classification:** Sistem otomatis memberikan predikat kelas seperti *Top Rated*, *Recommended*, atau *Regular* berdasarkan angka rating.

## 🛠️ Tech Stack
- **Framework:** Laravel 11 (PHP)
- **Database:** MySQL
- **Testing:** Postman

## 📦 Struktur Endpoint API

### Course Categories (`/api/categories`)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/api/categories` | Menampilkan semua kategori |
| `POST` | `/api/categories` | Menambahkan kategori baru |
| `GET` | `/api/categories/{id}` | Menampilkan detail kategori beserta kursusnya |
| `PUT` | `/api/categories/{id}` | Mengubah data kategori |
| `DELETE` | `/api/categories/{id}` | Menghapus kategori (dilengkapi proteksi relasi) |

### Courses (`/api/courses`)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/api/courses` | Menampilkan semua kelas (+ fitur search, filter, sort) |
| `POST` | `/api/courses` | Menambahkan kelas baru |
| `GET` | `/api/courses/{id}` | Menampilkan detail kelas beserta kategori dan instruktur |
| `PUT` | `/api/courses/{id}` | Mengubah data kelas |
| `DELETE` | `/api/courses/{id}` | Menghapus kelas |

---
*Created by Muhammad Hamdan Yusuf - Dibimbing Fullstack Web Development Batch 11*
