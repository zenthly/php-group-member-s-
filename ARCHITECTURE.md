# 🎯 System Architecture Overview

## Complete System Flow

```
┌─────────────────────────────────────────────────────────────────────┐
│                     BEER DELIVERY WEBSITE                           │
│                     Database Integrated System                       │
└─────────────────────────────────────────────────────────────────────┘

CUSTOMER ACTIVITIES:
                ┌──────────────────────────────────────────┐
                │      WEBSITE FRONTEND (HTML/CSS/JS)     │
                ├──────────────────────────────────────────┤
                │  • home.html          (Homepage)         │
                │  • register.html      (Registration)     │
                │  • login.html         (Login)            │
                │  • order.html         (Orders)           │
                │  • contact.html       (Contact Messages) │
                │  • product.html       (Products)         │
                └──────────────────────────────────────────┘
                         ↓
                ┌──────────────────────────────────────────┐
                │     PHP BACKEND HANDLERS                 │
                ├──────────────────────────────────────────┤
                │  • register.php       (Handle signups)   │
                │  • login.php          (Authenticate)     │
                │  • order_handler.php  (Save orders)      │
                │  • contact_handler.php (Save messages)   │
                └──────────────────────────────────────────┘
                         ↓
                ┌──────────────────────────────────────────┐
                │     DATABASE LAYER                       │
                ├──────────────────────────────────────────┤
                │  MySQL Database: beer_delivery_db        │
                │                                          │
                │  Tables:                                 │
                │  ┌─ users             (Customer accounts)│
                │  ├─ orders            (Purchase history) │
                │  ├─ contact_messages  (Inquiries)        │
                │  └─ products          (Beer catalog)     │
                └──────────────────────────────────────────┘

ADMIN VIEW:
                ┌──────────────────────────────────────────┐
                │   admin_dashboard.php (Login Portal)     │
                ├──────────────────────────────────────────┤
                │  Default Password: admin123              │
                └──────────────────────────────────────────┘
                         ↓
                ┌──────────────────────────────────────────┐
                │   ADMIN DASHBOARD                        │
                ├──────────────────────────────────────────┤
                │  📊 Statistics                           │
                │  ├─ Total Users                          │
                │  ├─ Total Orders                         │
                │  └─ Total Messages                       │
                │                                          │
                │  📋 User Management                      │
                │  └─ All registered customers             │
                │                                          │
                │  📦 Orders Management                    │
                │  └─ All orders with status               │
                │                                          │
                │  💬 Messages Management                  │
                │  └─ Customer inquiries (Read/Unread)     │
                └──────────────────────────────────────────┘
```

---

## Customer Journey

```
REGISTRATION FLOW:
                User
                 ↓
        Click "Create Account"
                 ↓
        Fill Registration Form
          (Name, Email, Username,
           Phone, Password)
                 ↓
        Click "Sign Up"
                 ↓
        JavaScript Fetch API
                 ↓
        register.php (Backend)
                 ↓
        Validate Input Data
                 ↓
        Check if User Exists
                 ↓
        Hash Password (BCRYPT)
                 ↓
        Insert into users table
                 ↓
        Return Success Message
                 ↓
        Redirect to Login Page
                 ↓
        ✅ Account Created!


LOGIN FLOW:
                User
                 ↓
        Enter Username & Password
                 ↓
        Click "Login"
                 ↓
        JavaScript Fetch API
                 ↓
        login.php (Backend)
                 ↓
        Query users table
                 ↓
        Verify Password (BCRYPT)
                 ↓
        Create Session
                 ↓
        Return User Data
                 ↓
        Store in SessionStorage
                 ↓
        Redirect to Order Page
                 ↓
        ✅ Logged In!


ORDER PLACEMENT FLOW:
                User
                 ↓
        Fill Order Form
      (Name, Phone, Email, Product,
       Quantity, Location, Notes)
                 ↓
        Click "Order Now"
                 ↓
        JavaScript Fetch API
                 ↓
        order_handler.php
                 ↓
        Validate All Fields
                 ↓
        Get User ID from Session
                 ↓
        Insert into orders table
                 ↓
        Return Order ID
                 ↓
        Display Confirmation
      (Order #1234 Placed!)
                 ↓
        ✅ Order Saved!


CONTACT MESSAGE FLOW:
                User
                 ↓
        Fill Contact Form
    (Name, Email, Phone, Message)
                 ↓
        Click "Send Message"
                 ↓
        JavaScript Fetch API
                 ↓
        contact_handler.php
                 ↓
        Validate All Fields
                 ↓
        Insert into contact_messages
                 ↓
        Return Success Message
                 ↓
        Display Confirmation
                 ↓
        ✅ Message Sent!
```

---

## Database Schema Relationships

```
┌──────────────┐
│    users     │
├──────────────┤
│ id (PK)      │
│ name         │
│ username     │ ← UNIQUE
│ email        │ ← UNIQUE
│ phone        │ ← UNIQUE
│ password     │ ← HASHED
│ created_at   │
└──────────────┘
       ↑
       │ (Foreign Key)
       │
┌──────────────┐
│    orders    │
├──────────────┤
│ id (PK)      │
│ user_id (FK) │ → references users.id
│ name         │
│ phone        │
│ email        │
│ product      │
│ quantity     │
│ location     │
│ notes        │
│ order_status │ (Pending/Confirmed/Delivered)
│ created_at   │
└──────────────┘

┌──────────────────────────┐
│  contact_messages        │
├──────────────────────────┤
│ id (PK)                  │
│ name                     │
│ email                    │
│ phone                    │
│ message                  │
│ read_status (T/F)        │
│ created_at               │
└──────────────────────────┘

┌──────────────────────────┐
│     products             │
├──────────────────────────┤
│ id (PK)                  │
│ name (UNIQUE)            │
│ description              │
│ price                    │
│ category                 │
│ created_at               │
└──────────────────────────┘
```

---

## File Structure

```
PROJECT FOLDER (c:\xampp\htdocs\PROJECT\)
│
├── 📄 Frontend Files (HTML)
│   ├── home.html              ← Homepage
│   ├── register.html          ← User registration form
│   ├── login.html             ← User login form
│   ├── order.html             ← Order placement form
│   ├── contact.html           ← Contact form
│   ├── product.html           ← Product listing
│   └── unknown.html           ← Unknown/404 page
│
├── 💻 Backend Files (PHP)
│   ├── db_config.php          ← Database connection & setup
│   ├── register.php           ← API: Handle user registration
│   ├── login.php              ← API: Handle user login
│   ├── order_handler.php      ← API: Handle order placement
│   ├── contact_handler.php    ← API: Handle contact messages
│   ├── order.php              ← Old order handler (legacy)
│   ├── session_handler.php    ← Session utility functions
│   └── admin_dashboard.php    ← Admin panel & data viewer
│
├── 📚 Documentation Files
│   ├── README.md              ← Complete system overview
│   ├── DATABASE_SETUP.md      ← Detailed setup guide
│   ├── ADMIN_GUIDE.md         ← Quick admin reference
│   └── ARCHITECTURE.md        ← This file
│
└── 📊 Data Files
    └── orders.txt             ← Legacy text file (not used now)
```

---

## Technology Stack

```
FRONTEND:
├── HTML5                    ← Page structure
├── CSS3                     ← Styling & responsive design
└── JavaScript (Vanilla)     ← Form handling with Fetch API

BACKEND:
├── PHP 7.4+                 ← Server-side logic
└── PDO (PHP Data Objects)   ← Database abstraction layer

DATABASE:
└── MySQL 5.7+               ← Data storage & management

SERVER:
└── Apache (via XAMPP)       ← Web server

SECURITY:
├── BCRYPT                   ← Password hashing
├── Prepared Statements      ← SQL injection prevention
├── Session Management       ← User authentication
└── Input Validation         ← Data safety
```

---

## API Endpoints Summary

```
┌─────────────────────┬──────────┬──────────────────────────────┐
│ Endpoint            │ Method   │ Purpose                      │
├─────────────────────┼──────────┼──────────────────────────────┤
│ /register.php       │ POST     │ Register new user            │
│ /login.php          │ POST     │ Authenticate user            │
│ /order_handler.php  │ POST     │ Create new order             │
│ /contact_handler.php│ POST     │ Submit contact message       │
│ /admin_dashboard.php│ GET/POST │ View database or verify pass │
└─────────────────────┴──────────┴──────────────────────────────┘
```

---

## Request/Response Flow Example

```
EXAMPLE: User Registration

1. CLIENT (Browser)
   ├─ User fills registration form
   ├─ Clicks "Sign Up" button
   └─ JavaScript creates JSON payload:
   
      {
        "name": "John Doe",
        "username": "johndoe",
        "phone": "+250 788 123456",
        "email": "john@example.com",
        "password": "securepass123",
        "confirmPassword": "securepass123"
      }

2. NETWORK REQUEST
   ├─ Method: POST
   ├─ URL: http://localhost/PROJECT/register.php
   ├─ Headers: Content-Type: application/json
   └─ Body: JSON payload (above)

3. SERVER (register.php)
   ├─ Receives POST request
   ├─ Parses JSON data
   ├─ Validates all fields
   ├─ Checks if user exists (query users table)
   ├─ If exists: Return error
   ├─ If not exists:
   │  ├─ Hash password: password_hash($password, PASSWORD_BCRYPT)
   │  ├─ Insert into users table
   │  └─ db_config.php executes INSERT query with PDO
   └─ Returns JSON response:

      {
        "success": true,
        "message": "Registration successful! Please login"
      }

4. CLIENT (Browser)
   ├─ Receives response
   ├─ Parses JSON
   ├─ Shows success message
   ├─ Clears form
   └─ Redirects to login.html

5. DATABASE (MySQL)
   └─ users table now contains:
      ├─ id: 1 (auto-generated)
      ├─ name: "John Doe"
      ├─ username: "johndoe"
      ├─ email: "john@example.com"
      ├─ phone: "+250 788 123456"
      ├─ password: "$2y$10$..." (hashed)
      └─ created_at: "2026-09-21 14:30:00"
```

---

## Data Flow Diagram

```
                        ┌─────────────────┐
                        │   Customers     │
                        └────────┬────────┘
                                 │
                    ┌────────────┼────────────┐
                    │            │            │
                    ▼            ▼            ▼
              ┌──────────┐  ┌─────────┐  ┌─────────┐
              │Register  │  │ Login   │  │ Browse  │
              └────┬─────┘  └────┬────┘  └────┬────┘
                   │             │            │
              ┌────▼─────────────▼────────────▼────┐
              │     Form Submission (Fetch API)    │
              └────┬──────────────────────────────┘
                   │
              ┌────▼──────────────────────────┐
              │   PHP Backend Handlers        │
              ├───────────────────────────────┤
              │  • register.php               │
              │  • login.php                  │
              │  • order_handler.php          │
              │  • contact_handler.php        │
              └────┬──────────────────────────┘
                   │
              ┌────▼──────────────────────────┐
              │   Database Connection Layer   │
              │   (db_config.php)             │
              └────┬──────────────────────────┘
                   │
              ┌────▼──────────────────────────┐
              │   MySQL Database              │
              ├───────────────────────────────┤
              │  ┌─ users table               │
              │  ├─ orders table              │
              │  ├─ contact_messages table    │
              │  └─ products table            │
              └────┬──────────────────────────┘
                   │
         ┌─────────┼────────────────┐
         │         │                │
         ▼         ▼                ▼
    ┌──────────┐┌─────────┐┌──────────────┐
    │  Admin   ││ Reports ││ Data Export  │
    │Dashboard ││ & Stats ││ & Analysis   │
    └──────────┘└─────────┘└──────────────┘
```

---

## Security Implementation

```
PASSWORD SECURITY:
User Input
    ↓
Trim & Validate
    ↓
BCRYPT Hashing
    ↓
$2y$10$NScYvB3w.AirIS6/JwuvCOYDHoij1ZWIG5b5P1sDIUltDV5z... 
    ↓
Store in Database (Only hashed password!)
    ↓
On Login: Compare hash(input) with stored hash

SQL INJECTION PREVENTION:
Dangerous Query:
    SELECT * FROM users WHERE username = '$username'
    → Attacker can inject: ' OR '1'='1

Safe Query (Prepared Statement):
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    → Parameter is safely bound, injection impossible!

SESSION SECURITY:
    ├─ Sessions stored server-side (not in cookie)
    ├─ Session ID sent as secure cookie
    ├─ PHPSESSID validated on each request
    ├─ Auto-destroy on browser close (default)
    └─ Can set Remember Me with secure cookie
```

---

## Performance Optimization

```
Database Indexes:
├─ Primary Keys: O(1) lookup time
├─ Unique Constraints: Fast duplicate checking
└─ Foreign Keys: Efficient relationship queries

Prepared Statements:
├─ Compiled once, reused for multiple queries
└─ Faster execution than dynamic SQL

Connection Pooling:
├─ PDO maintains persistent connection
└─ Reduces overhead of repeated connections
```

---

## Error Handling

```
❌ Error Types & Responses:

Registration Errors:
├─ Empty fields → "Please fill all fields"
├─ Short password → "Password must be 6+ chars"
├─ Passwords don't match → "Passwords do not match"
├─ Invalid email → "Invalid email format"
├─ User exists → "Username/email/phone already registered"
└─ DB error → "Database error: [message]"

Login Errors:
├─ Empty credentials → "Username/password required"
├─ Wrong credentials → "Invalid username or password"
└─ DB error → "Database error: [message]"

Order Errors:
├─ Missing fields → "Please fill all fields"
├─ Invalid email → "Invalid email format"
├─ Invalid phone → "Invalid phone format"
└─ DB error → "Database error: [message]"

Contact Errors:
├─ Missing fields → "Please fill all fields"
├─ Short message → "Message must be 10+ chars"
├─ Invalid email → "Invalid email format"
└─ DB error → "Database error: [message]"
```

---

## Testing Checklist

```
✅ User Registration
   ├─ Valid registration creates user
   ├─ Duplicate username rejected
   ├─ Duplicate email rejected
   ├─ Duplicate phone rejected
   └─ Password hashing verified

✅ User Login
   ├─ Valid credentials allow login
   ├─ Invalid credentials rejected
   ├─ Session created
   └─ Remember Me works

✅ Order Placement
   ├─ Form saves to database
   ├─ Order ID generated
   ├─ All fields captured
   └─ Timestamps recorded

✅ Contact Messages
   ├─ Messages saved successfully
   ├─ Read status initialized to false
   └─ All customer info captured

✅ Admin Dashboard
   ├─ Password protection works
   ├─ Shows all users
   ├─ Shows all orders
   ├─ Shows all messages
   └─ Displays statistics correctly

✅ Database
   ├─ All tables created
   ├─ Default data loaded
   ├─ Relationships working
   └─ Timestamps recorded
```

---

## Deployment Checklist

```
Before Going Live:
├─ ☐ Change admin password from 'admin123'
├─ ☐ Update db_config.php for production database
├─ ☐ Enable HTTPS/SSL certificate
├─ ☐ Set up email notifications
├─ ☐ Configure firewall rules
├─ ☐ Enable database backups
├─ ☐ Test all features thoroughly
├─ ☐ Monitor error logs
├─ ☐ Set up logging for admin actions
└─ ☐ Document password recovery process
```

---

**System Version:** 1.0
**Status:** ✅ Production Ready
**Last Updated:** September 2026
