<div align="center">

# 📦 Intsel Inventory Management System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.0-red?style=for-the-badge&logo=laravel" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2-blue?style=for-the-badge&logo=php" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-purple?style=for-the-badge&logo=bootstrap" alt="Bootstrap 5">
  <img src="https://img.shields.io/badge/Status-In--progress-green?style=for-the-badge" alt="Status In Progress">
</p>

### 🛠️ Inventory Management System built with Laravel 12

A robust, web-based inventory management system designed to help organizations streamline assets tracking, categories profiling, user privileges, and item borrowing transactions efficiently.

</div>

---

## 📖 Table of Contents

- [📌 About](#-about)
- [✨ Key Features](#-key-features)
- [⚙️ User Permissions](#-user-permissions)
- [🛠️ Technology Stack](#%EF%B8%8F-technology-stack)
- [🏗️ Software Architecture](#%EF%B8%8F-software-architecture)
- [📊 Database Design](#-database-design)
- [📈 Entity Relationship Diagram](#-entity-relationship-diagram)
- [📂 Project Structure](#-project-structure)
- [🚀 Installation & Configuration](#-installation--configuration)
- [🔑 Default Accounts](#-default-accounts)
- [🌐 Deployment](#-deployment)
- [📷 Screenshots](#-screenshots)
- [🔄 Future Improvements](#-future-improvements)
- [👨‍💻 Author](#-author)

---

## 📌 About

**Intsel Inventory Management System** adalah aplikasi berbasis web yang dikembangkan menggunakan **Laravel 12** untuk membantu pengelolaan logistik internal secara efisien dan terpantau. 

Sistem ini mencakup fungsionalitas penuh untuk pelacakan barang, manajemen kategori, kontrol transaksi peminjaman multi-produk, hingga analitik dasbor interaktif yang menerapkan arsitektur **Model-View-Controller (MVC)** dan sistem otentikasi berbasis peran (*Role-based Authentication*).

---

## ✨ Key Features

### 📊 Dashboard Analytics
* **Summary Widget:** Total ragam produk, jumlah produk dipinjam, produk tersedia, dan riwayat mutasi.
* **Recent Monitoring:** Daftar transaksi peminjaman terbaru dan daftar produk yang baru saja ditambahkan.

### 🔐 Authentication
* Menggunakan integrasi **Laravel Breeze** untuk manajemen sesi yang aman.
* Fitur mencakup *Login*, *Logout*, *Session Security Management*, dan proteksi rute halaman (*Protected Routes*).

### 👥 User Management
* Admin memiliki kuasa penuh untuk melakukan manajemen pengguna (*Create, Read, Update, Delete*).
* Pembagian otorisasi yang ketat menjadi 2 level hak akses: **Admin** dan **Staff**.

### 🏷️ Category & Product Management
* **CRUD Komplit:** Kelola data kategori barang dan spesifikasi detail produk.
* **Spesifikasi Produk:** Pencatatan kode unik produk, kategori, stok aktual, lokasi penyimpanan fisik, kondisi barang, hingga unggah berkas gambar (*Image Upload & Preview*).

### 📑 Borrowing Management
* **Multi-Product Order:** Satu transaksi peminjaman dapat menampung beberapa produk sekaligus (*One-to-Many detail relationship*).
* **Tracking Status:** Pencatatan nama peminjam, tanggal pinjam, batas tenggat pengembalian, dan otomatisasi *update* status peminjaman.

---

## ⚙️ User Permissions

| Fitur / Halaman | Admin | Staff |
| :--- | :---: | :---: |
| **Dashboard Analytics** | ✔️ | ✔️ |
| **Product & Category CRUD** | ✔️ | ✔️ |
| **Borrowing Management** | ✔️ | ✔️ |
| **User Management (CRUD)** | ✔️ | ❌ |
| **Full Access Control** | ✔️ | ❌ |

---

## 🛠️ Technology Stack

### Backend & Core
* **Framework:** Laravel 12.x
* **Language Runtime:** PHP 8.2+
* **Database Mapping:** Eloquent ORM

### Frontend Component
* **Template Engine:** Blade Template Engine
* **UI Framework:** Bootstrap 5.x
* **Scripting Language:** HTML5, CSS3, JavaScript (ES6)

### Database & Storage
* **Engine:** MySQL
* **File Driver:** Laravel Storage Integration via Symbolic Link

---

## 🏗️ Software Architecture

Aplikasi ini menerapkan pola desain **MVC (Model-View-Controller)** yang memisahkan antara logika bisnis, representasi data, dan tampilan antarmuka.
