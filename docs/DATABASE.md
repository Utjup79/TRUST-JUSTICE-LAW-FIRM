# TRUST & JUSTICE - Database Schema Documentation

## Database Overview

### Database Name
```
trust_justice_law_firm
```

### Tables Overview

1. **users** - User accounts and authentication
2. **roles** - User roles (Super Admin, Managing Partner, Lawyer, etc.)
3. **permissions** - Access control permissions
4. **role_permission** - Role-permission mapping
5. **clients** - Client information
6. **lawyers** - Lawyer profiles
7. **cases** - Legal cases
8. **hearings** - Court hearings
9. **case_hearing** - Case-Hearing relationship
10. **power_of_attorney** - Power of Attorney documents
11. **invoices** - Billing invoices
12. **invoice_items** - Invoice line items
13. **documents** - File management
14. **document_versions** - Document versioning
15. **reports** - System reports
16. **audit_logs** - System audit trail
17. **notification_logs** - Notification tracking

---

## Detailed Table Schemas

### 1. Users Table
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    two_factor_secret TEXT,
    two_factor_recovery_codes JSON,
    remember_token VARCHAR(100),
    profile_photo_path VARCHAR(255),
    photo_url VARCHAR(255),
    last_login_at TIMESTAMP NULL,
    is_active TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);
```

### 2. Roles Table
```sql
CREATE TABLE roles (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) UNIQUE NOT NULL,
    display_name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 3. Permissions Table
```sql
CREATE TABLE permissions (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) UNIQUE NOT NULL,
    display_name VARCHAR(255) NOT NULL,
    description TEXT,
    module VARCHAR(100),
    action VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 4. Role-Permission Pivot Table
```sql
CREATE TABLE role_permission (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    role_id BIGINT UNSIGNED NOT NULL,
    permission_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_role_permission (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
);
```

### 5. User-Role Pivot Table
```sql
CREATE TABLE user_role (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    role_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_role (user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);
```

### 6. Clients Table
```sql
CREATE TABLE clients (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    phone VARCHAR(20) NOT NULL,
    phone_alternative VARCHAR(20),
    address TEXT NOT NULL,
    city VARCHAR(100),
    province VARCHAR(100),
    postal_code VARCHAR(10),
    country VARCHAR(100) DEFAULT 'Indonesia',
    ktp_number VARCHAR(50),
    ktp_file_url VARCHAR(255),
    npwp_number VARCHAR(50),
    npwp_file_url VARCHAR(255),
    company_name VARCHAR(255),
    company_type VARCHAR(100),
    company_address TEXT,
    company_phone VARCHAR(20),
    company_email VARCHAR(255),
    company_website VARCHAR(255),
    client_type ENUM('individual', 'corporate') DEFAULT 'individual',
    notes TEXT,
    is_active TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);
```

### 7. Lawyers Table
```sql
CREATE TABLE lawyers (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    specialization VARCHAR(255),
    license_number VARCHAR(100),
    bar_association_number VARCHAR(100),
    bio TEXT,
    profile_photo_url VARCHAR(255),
    experience_years INT,
    education TEXT,
    certifications TEXT,
    hourly_rate DECIMAL(10, 2),
    availability_status ENUM('available', 'busy', 'on_leave') DEFAULT 'available',
    is_active TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### 8. Cases Table
```sql
CREATE TABLE cases (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    case_number VARCHAR(100) UNIQUE NOT NULL,
    client_id BIGINT UNSIGNED NOT NULL,
    lawyer_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    case_category VARCHAR(100),
    case_type ENUM('civil', 'criminal', 'corporate', 'family', 'other') NOT NULL,
    status ENUM('open', 'in_progress', 'on_hold', 'closed', 'archived') DEFAULT 'open',
    court_name VARCHAR(255),
    court_level VARCHAR(100),
    court_address TEXT,
    judge_name VARCHAR(255),
    opposing_party VARCHAR(255),
    opposing_lawyer VARCHAR(255),
    start_date DATE,
    end_date DATE,
    estimated_resolution_date DATE,
    budget DECIMAL(15, 2),
    spent_amount DECIMAL(15, 2) DEFAULT 0,
    priority ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (lawyer_id) REFERENCES lawyers(id) ON DELETE RESTRICT
);
```

### 9. Hearings Table
```sql
CREATE TABLE hearings (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    hearing_number VARCHAR(100) UNIQUE NOT NULL,
    court_name VARCHAR(255) NOT NULL,
    hearing_date DATETIME NOT NULL,
    hearing_location TEXT,
    judge_name VARCHAR(255),
    status ENUM('scheduled', 'rescheduled', 'completed', 'cancelled', 'postponed') DEFAULT 'scheduled',
    agenda TEXT,
    outcome TEXT,
    notes TEXT,
    reminder_sent_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 10. Case-Hearing Pivot Table
```sql
CREATE TABLE case_hearing (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    case_id BIGINT UNSIGNED NOT NULL,
    hearing_id BIGINT UNSIGNED NOT NULL,
    lawyer_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_case_hearing (case_id, hearing_id),
    FOREIGN KEY (case_id) REFERENCES cases(id) ON DELETE CASCADE,
    FOREIGN KEY (hearing_id) REFERENCES hearings(id) ON DELETE CASCADE,
    FOREIGN KEY (lawyer_id) REFERENCES lawyers(id) ON DELETE RESTRICT
);
```

### 11. Power of Attorney Table
```sql
CREATE TABLE power_of_attorney (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    poa_number VARCHAR(100) UNIQUE NOT NULL,
    client_id BIGINT UNSIGNED NOT NULL,
    lawyer_id BIGINT UNSIGNED NOT NULL,
    case_id BIGINT UNSIGNED,
    grantor_name VARCHAR(255) NOT NULL,
    grantee_name VARCHAR(255) NOT NULL,
    poa_type ENUM('general', 'specific', 'special', 'irrevocable') DEFAULT 'general',
    scope_of_authority TEXT,
    start_date DATE NOT NULL,
    end_date DATE,
    is_revoked TINYINT DEFAULT 0,
    revocation_date DATE,
    revocation_reason TEXT,
    document_url VARCHAR(255),
    qr_code_url VARCHAR(255),
    digital_signature VARCHAR(255),
    is_signed TINYINT DEFAULT 0,
    signed_date TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (lawyer_id) REFERENCES lawyers(id) ON DELETE RESTRICT,
    FOREIGN KEY (case_id) REFERENCES cases(id) ON DELETE SET NULL
);
```

### 12. Invoices Table
```sql
CREATE TABLE invoices (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    invoice_number VARCHAR(100) UNIQUE NOT NULL,
    client_id BIGINT UNSIGNED NOT NULL,
    lawyer_id BIGINT UNSIGNED NOT NULL,
    case_id BIGINT UNSIGNED,
    invoice_date DATE NOT NULL,
    due_date DATE NOT NULL,
    subtotal DECIMAL(15, 2) NOT NULL,
    tax DECIMAL(15, 2) DEFAULT 0,
    tax_percentage DECIMAL(5, 2) DEFAULT 0,
    total DECIMAL(15, 2) NOT NULL,
    payment_status ENUM('draft', 'sent', 'paid', 'partially_paid', 'overdue', 'cancelled') DEFAULT 'draft',
    paid_amount DECIMAL(15, 2) DEFAULT 0,
    payment_method VARCHAR(100),
    payment_date DATE,
    payment_reference VARCHAR(255),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (lawyer_id) REFERENCES lawyers(id) ON DELETE RESTRICT,
    FOREIGN KEY (case_id) REFERENCES cases(id) ON DELETE SET NULL
);
```

### 13. Invoice Items Table
```sql
CREATE TABLE invoice_items (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    invoice_id BIGINT UNSIGNED NOT NULL,
    description VARCHAR(255) NOT NULL,
    quantity DECIMAL(10, 2) DEFAULT 1,
    unit_price DECIMAL(15, 2) NOT NULL,
    amount DECIMAL(15, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE CASCADE
);
```

### 14. Documents Table
```sql
CREATE TABLE documents (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    document_number VARCHAR(100) UNIQUE NOT NULL,
    case_id BIGINT UNSIGNED,
    client_id BIGINT UNSIGNED,
    uploaded_by_id BIGINT UNSIGNED NOT NULL,
    folder_id BIGINT UNSIGNED,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    file_name VARCHAR(255) NOT NULL,
    file_url VARCHAR(255) NOT NULL,
    file_size BIGINT,
    file_type VARCHAR(50),
    document_type VARCHAR(100),
    is_confidential TINYINT DEFAULT 0,
    version INT DEFAULT 1,
    status ENUM('draft', 'active', 'archived', 'deleted') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (case_id) REFERENCES cases(id) ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by_id) REFERENCES users(id) ON DELETE RESTRICT
);
```

### 15. Document Versions Table
```sql
CREATE TABLE document_versions (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    document_id BIGINT UNSIGNED NOT NULL,
    version_number INT NOT NULL,
    file_url VARCHAR(255) NOT NULL,
    change_description TEXT,
    changed_by_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (document_id) REFERENCES documents(id) ON DELETE CASCADE,
    FOREIGN KEY (changed_by_id) REFERENCES users(id) ON DELETE RESTRICT
);
```

### 16. Reports Table
```sql
CREATE TABLE reports (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    report_type ENUM('client_summary', 'case_summary', 'revenue', 'lawyer_performance', 'hearing_schedule', 'custom') NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    generated_by_id BIGINT UNSIGNED NOT NULL,
    report_data JSON,
    export_format VARCHAR(50),
    file_url VARCHAR(255),
    filters JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (generated_by_id) REFERENCES users(id) ON DELETE RESTRICT
);
```

### 17. Audit Logs Table
```sql
CREATE TABLE audit_logs (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    action VARCHAR(255) NOT NULL,
    model_type VARCHAR(255),
    model_id BIGINT UNSIGNED,
    old_values JSON,
    new_values JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### 18. Notification Logs Table
```sql
CREATE TABLE notification_logs (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    notification_type VARCHAR(100),
    title VARCHAR(255),
    message TEXT,
    data JSON,
    is_read TINYINT DEFAULT 0,
    read_at TIMESTAMP NULL,
    sent_via VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## Indexes

```sql
-- Users
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_is_active ON users(is_active);
CREATE INDEX idx_users_deleted_at ON users(deleted_at);

-- Clients
CREATE INDEX idx_clients_email ON clients(email);
CREATE INDEX idx_clients_phone ON clients(phone);
CREATE INDEX idx_clients_is_active ON clients(is_active);

-- Cases
CREATE INDEX idx_cases_client_id ON cases(client_id);
CREATE INDEX idx_cases_lawyer_id ON cases(lawyer_id);
CREATE INDEX idx_cases_status ON cases(status);
CREATE INDEX idx_cases_case_number ON cases(case_number);

-- Hearings
CREATE INDEX idx_hearings_hearing_date ON hearings(hearing_date);
CREATE INDEX idx_hearings_status ON hearings(status);

-- Invoices
CREATE INDEX idx_invoices_client_id ON invoices(client_id);
CREATE INDEX idx_invoices_lawyer_id ON invoices(lawyer_id);
CREATE INDEX idx_invoices_payment_status ON invoices(payment_status);
CREATE INDEX idx_invoices_invoice_date ON invoices(invoice_date);

-- Documents
CREATE INDEX idx_documents_case_id ON documents(case_id);
CREATE INDEX idx_documents_client_id ON documents(client_id);
CREATE INDEX idx_documents_uploaded_by_id ON documents(uploaded_by_id);

-- Audit Logs
CREATE INDEX idx_audit_logs_user_id ON audit_logs(user_id);
CREATE INDEX idx_audit_logs_created_at ON audit_logs(created_at);
```

---

## Relationships Summary

- **Users** → has many **Roles**
- **Roles** → has many **Permissions**
- **Clients** → has many **Cases**
- **Clients** → has many **Invoices**
- **Clients** → has many **Power of Attorney**
- **Cases** → has many **Hearings** (many-to-many)
- **Cases** → has many **Documents**
- **Cases** → has many **Invoices**
- **Lawyers** → has many **Cases**
- **Lawyers** → has many **Hearings** (through Case-Hearing)
- **Hearings** → has many **Cases** (many-to-many)
- **Invoices** → has many **Invoice Items**
- **Documents** → has many **Document Versions**
