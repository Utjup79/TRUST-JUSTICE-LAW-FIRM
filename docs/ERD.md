# TRUST & JUSTICE - Entity Relationship Diagram

## ER Diagram (Text Format)

```
┌─────────────────────────────────────────────────────────────────────────┐
│                              USERS                                       │
├─────────────────────────────────────────────────────────────────────────┤
│ PK  id                                                                   │
│     name                                                                 │
│     email (UNIQUE)                                                       │
│     phone                                                                │
│     password                                                             │
│     profile_photo_path                                                   │
│     two_factor_secret                                                    │
│     last_login_at                                                        │
│     is_active (DEFAULT: 1)                                               │
│     created_at, updated_at, deleted_at                                   │
└─────────────────────────────────────────────────────────────────────────┘
                  │
         ┌────────┴────────┬─────────────────────────┐
         │                 │                         │
         ▼                 ▼                         ▼
    ┌─────────────┐   ┌──────────────┐        ┌─────────────────┐
    │   LAWYERS   │   │   CLIENTS    │        │  AUDIT_LOGS     │
    ├─────────────┤   ├──────────────┤        ├─────────────────┤
    │ id (FK)     │   │ id (FK)      │        │ id              │
    │ name        │   │ name         │        │ user_id (FK)    │
    │ email       │   │ email        │        │ action          │
    │ phone       │   │ phone        │        │ model_type      │
    │ specs       │   │ address      │        │ old_values      │
    │ license     │   │ ktp_num      │        │ new_values      │
    │ rate        │   │ npwp_num     │        │ ip_address      │
    │ bio         │   │ company      │        │ user_agent      │
    │ status      │   │ is_active    │        └─────────────────┘
    │ avatar      │   │ notes        │
    └─────────────┘   └──────────────┘
         │                 │
         │                 └──────────┬────────────────────────────────┐
         │                            │                                │
         │                 ┌──────────▼─────────┐  ┌───────────────────▼──────┐
         │                 │    CASES           │  │ POWER_OF_ATTORNEY       │
         │                 ├────────────────────┤  ├───────────────────────────┤
         │                 │ id                 │  │ id                       │
         │                 │ case_num           │  │ poa_number               │
         ├─────────────────┤ lawyer_id (FK)     │  │ client_id (FK)           │
         │                 │ client_id (FK)     │  │ lawyer_id (FK)           │
         │                 │ title              │  │ case_id (FK)             │
         │                 │ type               │  │ type                     │
         │                 │ status             │  │ start_date               │
         │                 │ court_name         │  │ end_date                 │
         │                 │ budget             │  │ signed                   │
         │                 │ spent              │  │ doc_url                  │
         │                 │ priority           │  │ qr_code                  │
         │                 │ notes              │  │ signature                │
         │                 └────────────────────┘  └───────────────────────────┘
         │                           │
         │                           ▼
         │                    ┌──────────────────────────────┐
         │                    │ CASE_HEARING                 │
         │                    │ (Pivot/Junction)             │
         │                    ├──────────────────────────────┤
         │                    │ id                           │
         │                    │ case_id (FK)                 │
         │                    │ hearing_id (FK)              │
         │                    │ lawyer_id (FK)               │
         │                    └──────────────────────────────┘
         │                           │
         │                           ▼
         │                    ┌──────────────────┐
         │                    │   HEARINGS       │
         │                    ├──────────────────┤
         │                    │ id                │
         │                    │ hearing_num       │
         │                    │ court_name        │
         │                    │ hearing_dt        │
         │                    │ location          │
         │                    │ judge_name        │
         │                    │ status            │
         │                    │ agenda            │
         │                    │ outcome           │
         │                    │ notes             │
         │                    └──────────────────┘
         │
         │
         └──────────┐
                    │
                    ▼
             ┌──────────────┐
             │  INVOICES    │
             ├──────────────┤
             │ id           │
             │ invoice_num  │
             │ client_id    │
             │ lawyer_id    │
             │ case_id      │
             │ inv_date     │
             │ due_date     │
             │ subtotal     │
             │ tax          │
             │ total        │
             │ status       │
             │ paid_amt     │
             │ payment_dt   │
             └──────────────┘
                  │
                  ▼
             ┌─────────────────────┐
             │ INVOICE_ITEMS       │
             ├─────────────────────┤
             │ id                  │
             │ invoice_id (FK)     │
             │ description         │
             │ quantity            │
             │ unit_price          │
             │ amount              │
             └─────────────────────┘

             ┌──────────────────┐
             │   DOCUMENTS      │
             ├──────────────────┤
             │ id               │
             │ doc_number       │
             │ case_id          │
             │ client_id        │
             │ uploaded_by      │
             │ title            │
             │ file_name        │
             │ file_url         │
             │ file_type        │
             │ version          │
             │ status           │
             │ confidential      │
             └──────────────────┘
                  │
                  ▼
             ┌──────────────────────────┐
             │ DOCUMENT_VERSIONS        │
             ├──────────────────────────┤
             │ id                       │
             │ document_id (FK)         │
             │ version_number           │
             │ file_url                 │
             │ change_desc              │
             │ changed_by_id (FK)       │
             └──────────────────────────┘

             ┌──────────────────┐
             │     ROLES        │
             ├──────────────────┤
             │ id               │
             │ name             │
             │ display_nm       │
             │ description      │
             └──────────────────┘
                  │
                  ▼
             ┌──────────────────────────┐
             │ ROLE_PERMISSION          │
             ├──────────────────────────┤
             │ id                       │
             │ role_id (FK)             │
             │ permission_id (FK)       │
             └──────────────────────────┘
                  │
                  ▼
             ┌──────────────────┐
             │ PERMISSIONS      │
             ├──────────────────┤
             │ id               │
             │ name             │
             │ display_nm       │
             │ module           │
             │ action           │
             └──────────────────┘

             ┌──────────────────┐
             │    REPORTS       │
             ├──────────────────┤
             │ id               │
             │ type             │
             │ title            │
             │ gen_by_id        │
             │ report_data      │
             │ file_url         │
             │ filters          │
             └──────────────────┘

             ┌────────────────────────────┐
             │ NOTIFICATION_LOGS          │
             ├────────────────────────────┤
             │ id                         │
             │ user_id (FK)               │
             ��� notif_type                 │
             │ title                      │
             │ message                    │
             │ data                       │
             │ is_read                    │
             │ read_at                    │
             │ sent_via                   │
             └────────────────────────────┘
```

## Entity Relationships

### Primary Keys
- All tables use `id` as BIGINT UNSIGNED PRIMARY KEY with AUTO_INCREMENT

### Foreign Key Relationships

| From Table | FK Column | To Table | Referenced Column | On Delete |
|------------|-----------|----------|-------------------|----------|
| lawyers | user_id | users | id | CASCADE |
| clients | user_id | users | id | SET NULL |
| cases | client_id | clients | id | CASCADE |
| cases | lawyer_id | lawyers | id | RESTRICT |
| case_hearing | case_id | cases | id | CASCADE |
| case_hearing | hearing_id | hearings | id | CASCADE |
| case_hearing | lawyer_id | lawyers | id | RESTRICT |
| power_of_attorney | client_id | clients | id | CASCADE |
| power_of_attorney | lawyer_id | lawyers | id | RESTRICT |
| power_of_attorney | case_id | cases | id | SET NULL |
| invoices | client_id | clients | id | CASCADE |
| invoices | lawyer_id | lawyers | id | RESTRICT |
| invoices | case_id | cases | id | SET NULL |
| invoice_items | invoice_id | invoices | id | CASCADE |
| documents | case_id | cases | id | CASCADE |
| documents | client_id | clients | id | CASCADE |
| documents | uploaded_by_id | users | id | RESTRICT |
| document_versions | document_id | documents | id | CASCADE |
| document_versions | changed_by_id | users | id | RESTRICT |
| reports | generated_by_id | users | id | RESTRICT |
| audit_logs | user_id | users | id | CASCADE |
| notification_logs | user_id | users | id | CASCADE |
| role_permission | role_id | roles | id | CASCADE |
| role_permission | permission_id | permissions | id | CASCADE |
| user_role | user_id | users | id | CASCADE |
| user_role | role_id | roles | id | CASCADE |

## Key Design Decisions

1. **Soft Deletes**: Users and Clients tables include `deleted_at` for soft deletion
2. **Timestamps**: All tables include `created_at` and `updated_at` for audit trail
3. **Enums**: Used for status fields (case status, payment status, etc.)
4. **JSON Fields**: Used for flexible data storage (two_factor_recovery_codes, report_data, audit values, notification data)
5. **Pivot Tables**: `case_hearing` and `role_permission`, `user_role` for many-to-many relationships
6. **Cascading Deletes**: Automatically delete related records when parent is deleted
7. **Restrict Deletes**: Prevent deletion of critical records (lawyers, permissions)
8. **Indexing**: All foreign keys and frequently queried columns are indexed

## Query Performance Considerations

- Composite indexes on frequently joined columns
- Status columns indexed for filtering
- Date columns indexed for range queries
- Email and phone indexed for search operations
- Separate versioning table to keep documents table lean
- Audit log separate from main tables for performance
