# TRUST & JUSTICE - REST API Documentation

## Base URL

```
Production: https://api.trustjustice.com/api
Development: http://localhost:8000/api
```

## Authentication

All API endpoints (except login/register) require authentication using Laravel Sanctum.

### Bearer Token
```
Authorization: Bearer {token}
```

---

## API Endpoints

### Authentication Routes

#### 1. Register
```http
POST /auth/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "phone": "+6281234567890"
}

Response: 201 Created
{
  "message": "User registered successfully",
  "data": {
    "user": { ... },
    "token": "abc123..."
  }
}
```

#### 2. Login
```http
POST /auth/login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "password123"
}

Response: 200 OK
{
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "roles": ["lawyer"]
    },
    "token": "abc123..."
  }
}
```

#### 3. Logout
```http
POST /auth/logout
Authorization: Bearer {token}

Response: 200 OK
{
  "message": "Logged out successfully"
}
```

#### 4. Refresh Token
```http
POST /auth/refresh
Authorization: Bearer {token}

Response: 200 OK
{
  "data": {
    "token": "new_token..."
  }
}
```

#### 5. Get Current User
```http
GET /auth/me
Authorization: Bearer {token}

Response: 200 OK
{
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+6281234567890",
    "roles": ["lawyer"],
    "permissions": ["create_cases", "view_cases", ...]
  }
}
```

---

### Client Routes

#### 1. List Clients
```http
GET /clients?page=1&per_page=10&search=John&status=active
Authorization: Bearer {token}

Response: 200 OK
{
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "+6281234567890",
      "address": "123 Main St",
      "ktp_number": "1234567890123456",
      "npwp_number": "12.345.678.9-012.345",
      "company_name": "PT. Example Corp",
      "client_type": "individual",
      "is_active": true,
      "created_at": "2026-01-15T10:30:00Z"
    }
  ],
  "pagination": {
    "current_page": 1,
    "total": 50,
    "per_page": 10,
    "last_page": 5
  }
}
```

#### 2. Create Client
```http
POST /clients
Authorization: Bearer {token}
Content-Type: application/json

{
  "name": "Jane Smith",
  "email": "jane@example.com",
  "phone": "+6287654321098",
  "address": "456 Oak Ave",
  "city": "Jakarta",
  "province": "DKI Jakarta",
  "postal_code": "12345",
  "ktp_number": "9876543210987654",
  "npwp_number": "98.765.432.1-987.654",
  "company_name": "PT. New Corp",
  "company_type": "Limited",
  "client_type": "corporate",
  "notes": "Important client"
}

Response: 201 Created
{
  "message": "Client created successfully",
  "data": { ... }
}
```

#### 3. Get Client
```http
GET /clients/{id}
Authorization: Bearer {token}

Response: 200 OK
{
  "data": { ... }
}
```

#### 4. Update Client
```http
PUT /clients/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
  "name": "Jane Smith Updated",
  "email": "jane.updated@example.com",
  ...
}

Response: 200 OK
{
  "message": "Client updated successfully",
  "data": { ... }
}
```

#### 5. Delete Client
```http
DELETE /clients/{id}
Authorization: Bearer {token}

Response: 204 No Content
```

---

### Case Routes

#### 1. List Cases
```http
GET /cases?page=1&per_page=10&status=open&sort=-created_at
Authorization: Bearer {token}

Response: 200 OK
{
  "data": [
    {
      "id": 1,
      "case_number": "CASE-2026-001",
      "title": "Dispute Resolution",
      "client_id": 1,
      "client_name": "John Doe",
      "lawyer_id": 1,
      "lawyer_name": "Jane Lawyer",
      "case_type": "civil",
      "status": "open",
      "court_name": "Central District Court",
      "priority": "high",
      "budget": 50000000,
      "spent_amount": 15000000,
      "start_date": "2026-01-10",
      "end_date": null,
      "created_at": "2026-01-15T10:30:00Z"
    }
  ],
  "pagination": { ... }
}
```

#### 2. Create Case
```http
POST /cases
Authorization: Bearer {token}
Content-Type: application/json

{
  "title": "New Legal Case",
  "description": "Case description here",
  "client_id": 1,
  "lawyer_id": 1,
  "case_type": "civil",
  "case_category": "contract_dispute",
  "court_name": "Central District Court",
  "judge_name": "Judge John",
  "opposing_party": "Opposing Corp",
  "budget": 50000000,
  "priority": "high",
  "start_date": "2026-01-15"
}

Response: 201 Created
{
  "message": "Case created successfully",
  "data": { ... }
}
```

#### 3. Get Case
```http
GET /cases/{id}
Authorization: Bearer {token}

Response: 200 OK
{
  "data": {
    "id": 1,
    "case_number": "CASE-2026-001",
    ...,
    "hearings": [ ... ],
    "documents": [ ... ],
    "invoices": [ ... ]
  }
}
```

#### 4. Update Case
```http
PUT /cases/{id}
Authorization: Bearer {token}
Content-Type: application/json

{
  "title": "Updated Title",
  "status": "in_progress",
  "spent_amount": 20000000
}

Response: 200 OK
{
  "message": "Case updated successfully",
  "data": { ... }
}
```

#### 5. Delete Case
```http
DELETE /cases/{id}
Authorization: Bearer {token}

Response: 204 No Content
```

---

### Invoice Routes

#### 1. List Invoices
```http
GET /invoices?payment_status=unpaid&sort=-created_at
Authorization: Bearer {token}

Response: 200 OK
{
  "data": [
    {
      "id": 1,
      "invoice_number": "INV-2026-001",
      "client_id": 1,
      "client_name": "John Doe",
      "invoice_date": "2026-01-15",
      "due_date": "2026-02-15",
      "subtotal": 50000000,
      "tax": 5000000,
      "total": 55000000,
      "payment_status": "unpaid",
      "items": [ ... ]
    }
  ]
}
```

#### 2. Create Invoice
```http
POST /invoices
Authorization: Bearer {token}
Content-Type: application/json

{
  "client_id": 1,
  "lawyer_id": 1,
  "case_id": 1,
  "invoice_date": "2026-01-15",
  "due_date": "2026-02-15",
  "tax_percentage": 10,
  "items": [
    {
      "description": "Legal consultation",
      "quantity": 5,
      "unit_price": 5000000
    }
  ]
}

Response: 201 Created
{
  "message": "Invoice created successfully",
  "data": { ... }
}
```

#### 3. Update Payment Status
```http
PUT /invoices/{id}/payment-status
Authorization: Bearer {token}
Content-Type: application/json

{
  "payment_status": "paid",
  "paid_amount": 55000000,
  "payment_date": "2026-02-10",
  "payment_reference": "TRF-2026-001"
}

Response: 200 OK
{
  "message": "Payment status updated",
  "data": { ... }
}
```

#### 4. Export Invoice PDF
```http
GET /invoices/{id}/pdf
Authorization: Bearer {token}

Response: 200 OK
[PDF File Content]
```

---

### Document Routes

#### 1. List Documents
```http
GET /documents?case_id=1&sort=-created_at
Authorization: Bearer {token}

Response: 200 OK
{
  "data": [
    {
      "id": 1,
      "document_number": "DOC-2026-001",
      "title": "Case Brief",
      "file_name": "case_brief.pdf",
      "file_url": "https://...",
      "file_type": "pdf",
      "version": 2,
      "status": "active",
      "uploaded_by": "Jane Lawyer",
      "created_at": "2026-01-15T10:30:00Z"
    }
  ]
}
```

#### 2. Upload Document
```http
POST /documents
Authorization: Bearer {token}
Content-Type: multipart/form-data

Form Data:
- case_id: 1
- title: "Case Brief"
- document_type: "brief"
- file: [binary file]
- is_confidential: true

Response: 201 Created
{
  "message": "Document uploaded successfully",
  "data": { ... }
}
```

#### 3. Get Document Versions
```http
GET /documents/{id}/versions
Authorization: Bearer {token}

Response: 200 OK
{
  "data": [
    {
      "version_number": 2,
      "file_url": "https://...",
      "change_description": "Fixed typos",
      "changed_by": "Jane Lawyer",
      "created_at": "2026-01-20T14:30:00Z"
    }
  ]
}
```

#### 4. Download Document
```http
GET /documents/{id}/download
Authorization: Bearer {token}

Response: 200 OK
[File Content]
```

---

### Reports Routes

#### 1. Get Dashboard Statistics
```http
GET /reports/dashboard-stats?from_date=2026-01-01&to_date=2026-12-31
Authorization: Bearer {token}

Response: 200 OK
{
  "data": {
    "total_clients": 50,
    "total_cases": 35,
    "total_revenue": 500000000,
    "pending_hearings": 5,
    "unpaid_invoices": 10,
    "unpaid_amount": 100000000
  }
}
```

#### 2. Generate Revenue Report
```http
POST /reports/revenue
Authorization: Bearer {token}
Content-Type: application/json

{
  "format": "excel",
  "from_date": "2026-01-01",
  "to_date": "2026-12-31",
  "group_by": "lawyer"
}

Response: 200 OK
{
  "message": "Report generated successfully",
  "data": {
    "url": "https://..."
  }
}
```

---

## Response Format

### Success Response
```json
{
  "success": true,
  "message": "Operation successful",
  "data": { ... },
  "status_code": 200
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error message",
  "errors": {
    "field_name": ["Error message"]
  },
  "status_code": 400
}
```

---

## Status Codes

- `200` - OK
- `201` - Created
- `204` - No Content
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Unprocessable Entity
- `429` - Too Many Requests
- `500` - Internal Server Error

---

## Rate Limiting

- **Default**: 60 requests per minute
- **Authenticated**: 1000 requests per hour
- **Headers**: `X-RateLimit-Limit`, `X-RateLimit-Remaining`, `X-RateLimit-Reset`

---

## Pagination

All list endpoints support pagination:

```
GET /endpoint?page=1&per_page=10
```

Response includes:
```json
{
  "data": [...],
  "pagination": {
    "current_page": 1,
    "total": 100,
    "per_page": 10,
    "last_page": 10,
    "from": 1,
    "to": 10
  }
}
```
