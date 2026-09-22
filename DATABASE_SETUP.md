# 🍺 Beer Delivery Website - Database Setup Guide

## Complete Database Integration System

Your website is now connected to a MySQL database that tracks all customer activities including registrations, logins, orders, and contact messages.

---

## 📋 What's Been Set Up

### Database Tables Created:
1. **users** - Store registered customer accounts
2. **orders** - Track all customer orders
3. **contact_messages** - Store customer inquiries
4. **products** - Manage beer products

### PHP Backend Files Created:
- `db_config.php` - Database connection & initialization
- `register.php` - Handle user registration
- `login.php` - Handle user login
- `order_handler.php` - Save orders to database
- `contact_handler.php` - Save contact messages
- `admin_dashboard.php` - View all data in admin panel

---

## 🚀 Quick Start Guide

### Step 1: Ensure XAMPP is Running
1. Open XAMPP Control Panel
2. Start **Apache** and **MySQL** services

### Step 2: Access the Website
- Go to: `http://localhost/PROJECT/home.html`
- The database will be created automatically on first access

### Step 3: Test the Features

#### Register a New Customer:
1. Click **Login** in the navigation
2. Click **Create account** link
3. Fill in the registration form and submit
4. ✓ User data is saved to database

#### Login:
1. Use the username and password you just created
2. Check **Remember me** if desired
3. ✓ User session is created

#### Place an Order:
1. After login, go to **Order** page
2. Fill in order details:
   - Name, Phone, Email
   - Select Product (e.g., "Beer Premium 500ml")
   - Enter Quantity
   - Delivery Location
   - Optional notes
3. Click **Order Now**
4. ✓ Order is saved to database with status "Pending"

#### Send a Contact Message:
1. Go to **Contact** page
2. Fill in your details and message
3. Click **Send Message**
4. ✓ Message is saved to database

---

## 📊 Admin Dashboard

### Access the Admin Panel:
**URL:** `http://localhost/PROJECT/admin_dashboard.php`

**Default Password:** `admin123`

⚠️ **IMPORTANT:** Change this password in production!
- Edit `admin_dashboard.php`
- Find line: `$admin_password = 'admin123';`
- Change to a secure password

### What You Can See:
1. **Statistics** - Total users, orders, messages
2. **Users List** - All registered customers (Name, Email, Phone, Registration Date)
3. **Orders List** - All orders with status, customer info, delivery location
4. **Contact Messages** - All customer inquiries (marked as Read/Unread)

### Order Status Options:
- **Pending** - Order received, awaiting confirmation
- **Confirmed** - Order confirmed by admin
- **Delivered** - Order completed

---

## 🔧 Database Configuration

### Location: `db_config.php`

Current settings:
```php
$host = 'localhost';
$db_name = 'beer_delivery_db';
$db_user = 'root';
$db_password = '';
```

### Change Database Credentials:
1. Open `db_config.php`
2. Update the variables at the top
3. Save the file

Example for remote database:
```php
$host = 'your-server.com';
$db_name = 'beer_db';
$db_user = 'your_username';
$db_password = 'your_password';
```

---

## 📱 Form & API Endpoints

### Registration
- **URL:** `/register.php`
- **Method:** POST (JSON)
- **Fields:** name, username, phone, email, password, confirmPassword

### Login
- **URL:** `/login.php`
- **Method:** POST (JSON)
- **Fields:** username, password, rememberMe

### Place Order
- **URL:** `/order_handler.php`
- **Method:** POST (JSON)
- **Fields:** name, phone, email, product, quantity, location, notes

### Contact Message
- **URL:** `/contact_handler.php`
- **Method:** POST (JSON)
- **Fields:** name, email, phone, message

---

## 🔐 Security Tips

1. **Change Admin Password:**
   ```php
   $admin_password = 'YourSecurePassword'; // Edit admin_dashboard.php line 18
   ```

2. **Passwords are Hashed:**
   - Using BCRYPT algorithm
   - Safe from exposure

3. **Use HTTPS in Production:**
   - Install SSL certificate
   - Change `db_config.php` to use HTTPS connections

4. **SQL Injection Protection:**
   - All queries use prepared statements
   - Parameters are safely bound

5. **Email Verification (Future):**
   - Consider adding email verification for registrations
   - Add SMS verification for orders

---

## 📝 Database Structure

### users Table:
```
id (Primary Key)
name
username (Unique)
email (Unique)
phone (Unique)
password (Hashed)
created_at
updated_at
```

### orders Table:
```
id (Primary Key)
user_id (Foreign Key)
name
phone
email
product
quantity
location
notes
order_status
created_at
updated_at
```

### contact_messages Table:
```
id (Primary Key)
name
email
phone
message
read_status
created_at
```

### products Table:
```
id (Primary Key)
name
description
price
category
created_at
```

---

## 🐛 Troubleshooting

### Issue: "Database Connection Error"
- ✓ Check if MySQL is running in XAMPP
- ✓ Verify credentials in `db_config.php`
- ✓ Database name should be: `beer_delivery_db`

### Issue: "User already exists"
- ✓ Username, email, or phone is already registered
- ✓ Use a unique value

### Issue: "Order not saving"
- ✓ Check browser console for errors (F12)
- ✓ Verify all required fields are filled
- ✓ Check PHP error logs in XAMPP

### Issue: "Can't access admin dashboard"
- ✓ Check if you entered the correct password
- ✓ Password is case-sensitive
- ✓ Default: `admin123`

---

## 🎯 Next Steps (Enhancements)

1. **Email Notifications:**
   - Send confirmation emails on registration
   - Send order status updates

2. **Payment Integration:**
   - Add Stripe, PayPal, or local payment gateway
   - Track payment status

3. **SMS Alerts:**
   - Send order updates via SMS
   - Two-factor authentication

4. **Search & Filter:**
   - Search orders by date
   - Filter by order status

5. **Reports:**
   - Generate sales reports
   - Customer analytics

6. **Multi-language:**
   - Support Kinyarwanda
   - Support French

---

## 📞 Support

For issues or questions:
- Check the admin dashboard for data validation
- Review error messages in browser console (F12)
- Verify database connection in `db_config.php`
- Check XAMPP MySQL status

---

## ✅ Verification Checklist

- [ ] XAMPP Apache and MySQL are running
- [ ] Can access http://localhost/PROJECT/home.html
- [ ] Can register a new user
- [ ] Can login with registered user
- [ ] Can place an order
- [ ] Can submit contact message
- [ ] Can access admin dashboard at http://localhost/PROJECT/admin_dashboard.php
- [ ] Can see registered users in admin panel
- [ ] Can see orders in admin panel
- [ ] Can see contact messages in admin panel

---

**Last Updated:** September 2026
**Database Version:** 1.0
**Status:** ✓ Production Ready
