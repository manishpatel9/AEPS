# AEPS Pro Platform - Complete Documentation

## Overview
AEPS Pro is a production-grade, highly secure Aadhaar Enabled Payment System built with Laravel 12 and PHP 8.3. This platform operates as a massive structural fintech website featuring a multi-tier hierarchy (Admin, Distributor, Retailer) designed to manage large volumes of transactions via an Aadhaar-linked banking system.

The project encompasses everything from an aesthetic modern landing page to complex functionalities like cash withdrawals, balance enquiries, mini statements, comprehensive double-entry wallet bookkeeping, sophisticated admin panels, support ticket system, KYC verifications, and robust logging architecture.

## Features Included

### 🏢 **User & Hierarchy Management**
*   **Role-Based Access Control (RBAC):** Admin (Full control), Distributor (Retailer management), Retailer/Agent (Transaction execution).
*   **Secure Authentication:** Encrypted passwords, role assignment, and robust login logging.
*   **KYC Verification:** Profile tracking, document uploads (Aadhaar, PAN), and Admin approval flow.
*   **Hierarchical Relations:** Distributors can track retailer performance and wallet balances.

### 💰 **Core Financial Services (AEPS & Bills)**
*   **Cash Withdrawal:** Secure extraction of funds via Aadhaar (Simulated biometric & API).
*   **Balance Enquiry:** Quick access to Aadhaar-linked bank accounts.
*   **Mini Statement:** Last 5-10 transactions logging.
*   **Bill Payments & Recharge:** Broad service support (Electricity, DTH, Water, Mobile Recharges).
*   **Dynamic Commission System:** Service-charge calculation, dynamic percentages based on transaction modules.

### 🏦 **Wallet & Ledger (Double-Entry Bookkeeping)**
*   **Wallet:** Users maintain two balances: Main Balance & Asset (Settlable) Balance.
*   **Ledger System:** Strictly structured double-entry (`credit`/`debit`) to ensure full auditability. Every financial move generates a transparent ledger entry linking the old and new balance state.
*   **Fund Transfers:** Send money directly from Admin -> Distributor -> Retailer.

### 📊 **Admin System & Reporting**
*   **Admin Dashboard:** High-level volume indicators, active members, pending approvals, support tickets.
*   **Bank Management:** Toggle Supported banks & their IIN numbers.
*   **API Management:** Route transactions through dynamic API Provider routing.
*   **Settlements (Payouts):** User wallet to bank account payouts handler.
*   **Reversals/Fphum Handling:** Advanced workflow for failed, reversed, or refunded transactions.
*   **Service Charges Module:** Modify percentage cuts and fixed-rate commissions for AEPS & Recharges natively.

### 🛡️ **Robust Logging Infrastructure**
*   `login_logs`: IP tracking, user agents.
*   `audit_logs`: Tracking crucial entity modifications (Who edited what, when, and IP).
*   `transaction_logs`: Specific endpoint tracking for success/failed state changes.
*   `api_logs`: Request and Response payloads specifically tracking upstream requests.
*   `activity_logs`: Plain-text generic contextual actions.

---

## Technical Specifications

*   **Framework:** Laravel 12.x
*   **Language:** PHP 8.3
*   **Database:** MySQL (MariaDB supported via XAMPP)
*   **Frontend Design System:** Custom Vanilla CSS with extreme care for premium UX/UI. Inter Font, FontAwesome, modern glassmorphism, native grid systems, zero bloated framework reliance.

---

## Installation & Deployment (Local XAMPP)

1.  **Extract the Project:**
    Place the complete `Aeps_x` folder in your `C:\xampp\htdocs\` directory.
2.  **Database Configuration:**
    *   Open `phpMyAdmin` (`http://localhost/phpmyadmin`).
    *   Create a new blank database named `aeps_db`.
    *   Import the provided `aeps_db.sql` file (found in the project root directory) into this database.
3.  **Environment Setup:**
    Ensure the `.env` file credentials match your DB:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=aeps_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```
4.  **Launch the System:**
    *   Open XAMPP Control Panel and ensure `Apache` and `MySQL` are running.
    *   Access the site on your browser:
        `http://localhost/Aeps_x/public`

---

 

*(All passwords bypass minimum character lengths purely for demo configurations. In real deployment, change these immediately).*

---

## Security Practices Followed

1.  **Aadhaar Privacy:** Direct Aadhaar numbers are never stored in plain text. A SHA-256 Hash combined with the application key (`aadhaar_hash`) holds the primary identifier, while only the Last 4 digits (`aadhaar_last4`) are stored for UI referencing.
2.  **Encrypted Configurations:** Any sensitive API provider mapping keys are cast as `encrypted` directly via standard Laravel eloquent `$casts`.
3.  **Preventing IDOR / Multi-Tenancy Errors:** Controllers (`AepsController.php`, `WalletController.php`) meticulously verify that requested resources (ledgers, user IDs) belong exclusively to the `auth()->user()`. Role Middleware intercepts any route escalation attempts.
