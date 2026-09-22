# 🔑 Quick Reference - Database Administration

## Admin Dashboard Login
**URL:** http://localhost/PROJECT/admin_dashboard.php
**Password:** admin123

---

## 📊 What You'll See on Admin Dashboard

### Dashboard Sections:

#### 1️⃣ **Statistics Cards** (Top)
- Total Users Count
- Total Orders Count
- Total Contact Messages Count

#### 2️⃣ **Users Section**
Find all registered customers with:
- User ID
- Full Name
- Username
- Email Address
- Phone Number
- Registration Date & Time

#### 3️⃣ **Orders Section**
View all orders with:
- Order ID (Order #)
- Customer Name
- Email
- Phone
- Product Name
- Quantity
- Delivery Location
- Order Status (Pending/Confirmed/Delivered)
- Order Date & Time

#### 4️⃣ **Contact Messages Section**
See all customer inquiries:
- Message ID
- Customer Name
- Email
- Phone
- Message Preview (first 50 characters)
- Read Status (Read = Green, Unread = Orange)
- Submission Date & Time

---

## 🎯 Common Admin Tasks

### View All Registered Customers
1. Go to Admin Dashboard
2. Login with password
3. Scroll to **📋 Registered Users** section
4. See all customer details

### Check All Orders
1. Login to Admin Dashboard
2. Scroll to **📦 All Orders** section
3. View order status, customer info, and location
4. Orders show as "Pending" by default

### Read Customer Messages
1. Login to Admin Dashboard
2. Scroll to **💬 Contact Messages** section
3. Unread messages have orange background
4. Read messages have green background

### Update Order Status
Instructions coming soon! (Feature to add)

---

## 🔐 Security Checklist

- [ ] Change admin password from 'admin123'
- [ ] Edit `admin_dashboard.php` line 18
- [ ] Replace with a strong password
- [ ] Don't share the password
- [ ] Log out when done
- [ ] Use HTTPS in production

---

## 📈 Sample Data

### Default Products Loaded:
1. Beer Premium 500ml - RWF 5,000
2. Beer Standard 350ml - RWF 3,000
3. Beer Light 500ml - RWF 4,500
4. Beer Export Lager - RWF 6,000
5. Mixed Pack 6 Beers - RWF 25,000

---

## 🆘 Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| Can't login to admin | Check if password is 'admin123' (case-sensitive) |
| No users showing | Users only appear after registration |
| No orders showing | Orders only appear after order placement |
| Site says "Database Error" | Check if MySQL is running in XAMPP |
| Can't register users | Check if username/email/phone is already used |

---

## 📱 Website Features for Customers

### Customer Can:
- ✅ Register with unique username
- ✅ Login to account
- ✅ Place orders for products
- ✅ Track order status
- ✅ Send contact messages
- ✅ Receive order confirmations

### Data Captured:
- ✅ Name, Email, Phone, Address
- ✅ Passwords (securely hashed)
- ✅ Order history
- ✅ Contact inquiries
- ✅ Timestamps for all activities

---

## 🛠️ Change Admin Password

### Step-by-Step:
1. Open file: `admin_dashboard.php`
2. Go to **Line 17-18**
3. Find: 
   ```php
   $admin_password = 'admin123';
   ```
4. Change to:
   ```php
   $admin_password = 'YourNewPassword123!';
   ```
5. Save file
6. Now use new password to login

---

## 📊 Data Export Tips

### To Backup Username List:
1. View Users section in admin dashboard
2. Use browser's "Print" feature
3. Save as PDF

### To Backup Orders:
1. View Orders section
2. Take screenshot or print
3. Save for records

---

## ⚙️ System Files Overview

### Configuration:
- `db_config.php` - Database connection settings

### Frontend (HTML):
- `home.html` - Homepage
- `register.html` - Registration form
- `login.html` - Login form
- `order.html` - Order placement
- `contact.html` - Contact form

### Backend (PHP):
- `register.php` - User registration handler
- `login.php` - User login handler
- `order_handler.php` - Order submission handler
- `contact_handler.php` - Message submission handler
- `admin_dashboard.php` - Admin panel & data viewer

### Database:
- `beer_delivery_db` - Your MySQL database
  - 4 tables: users, orders, contact_messages, products

---

## 📞 Emergency Contacts

If something breaks:
1. Check XAMPP MySQL status
2. Verify db_config.php settings
3. Check browser console (F12) for errors
4. Review PHP error logs in XAMPP

---

## 💡 Tips

- **Remember Session:** Users stay logged in during their session
- **Remember Me:** Saves login preference in browser cookies
- **Order Status:** All new orders start as "Pending"
- **Message Status:** Messages are "Unread" by default
- **Timestamps:** All activities are logged with date & time

---

**Version:** 1.0
**Last Updated:** September 2026
**Database:** MySQL
**Status:** ✅ Fully Operational
