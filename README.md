# 📑 Invoice Management System (Laravel)

A comprehensive system for managing invoices, sections, and products with advanced permissions and detailed reporting, built using the **Laravel ** framework.

---

## 🚀 Key Features

*   **📊 Smart Dashboard:** View invoice statistics and payment percentages (Paid, Unpaid, Partial) using interactive charts.
*   **📑 Invoice Management:** Add, edit, delete, archive, and print professional invoices.
*   **🔄 Payment Status Tracking:** Update invoice status (Paid, Partially Paid, Unpaid) with payment date recording.
*   **📂 Attachment Management:** Upload, download, preview, and delete invoice-related attachments (Images, PDFs, etc.).
*   **🔐 Roles & Permissions:** Full user and permission management powered by `Spatie Laravel Permission`.
*   **📈 Advanced Reporting:** 
    *   **Invoices Report:** Search by invoice number, type, or date range.
    *   **Customers Report:** Search by section, product, and date range.
*   **📥 Data Export:** Export invoice lists and reports directly to **Excel** files.
*   **🔔 Notifications:** Built-in notification system for new invoice activities.

---

## 🛠 Tech Stack

| Technology | Description |
| :--- | :--- |
| **Framework** | Laravel 11.x |
| **PHP Version** | ^8.2 |
| **Frontend** | Tailwind CSS & Vite |
| **Authentication** | Laravel UI |
| **Permissions** | Spatie Laravel Permission |
| **Excel Export** | Maatwebsite Excel |
| **Charts** | ConsoleTVs Charts |

---

## ⚙️ Prerequisites

*   PHP >= 8.2
*   Composer
*   Node.js & NPM
*   Database (MySQL or SQLite)

---

## 📥 Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/invoice-system.git
   cd invoice-system
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Set up Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration:**
   *Create a database and update your `.env` file with the connection details.*
   ```bash
   php artisan migrate --seed
   ```

5. **Run the Application:**
   ```bash
   php artisan serve
   ```

---

## 👥 Default Login Credentials

*   **Email:** `admin@example.com` (Check seeders for specific admin email)
*   **Password:** `12345678`

## 📧 Contact

For any inquiries, feel free to reach out:
- **Name:** Abdallah
- **Email:** abdallahwael352@gmail.com
```
