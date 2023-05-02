## Inventory Management System using Laravel

__ Overview __ The purpose of this project is to develop an inventory management system that allows the admin and super admin of a company to easily manage their electronic stuff, IP addresses, VPN, and user list. The system will provide a user-friendly interface that allows authorized users to manage and monitor inventory levels, generate reports, and perform other administrative tasks.
- - - - -
## Features

- `Login and user management` The system will allow multiple users to log in with different roles, such as admin and super admin, and will provide authentication and authorization features.
- `Dashboard` The dashboard will provide an overview of the inventory levels, activity log, admin create, admin list, change password, logout, and other relevant information.
- `Privilege management` The super admin can give privilege of the database to the normal admin. The normal admin can manage the database with the privilege given by the super admin. The delete option is only available for super admin.
- `Activity log` There is an activity log for super admin to track and monitor user activity.
- `Inventory management` The system will allow the admin and super admin to manage their electronic stuff, IP addresses, VPN, and user list. They can add, update, issue, and reissue products, and can also view details of each item, such as Product Serial No, Warranty Expire Date, Vendor etc.
- `Search functionality` The system will allow the user to search for specific items based on various criteria, such as name, category, or Vendor. Every data table has its own filtering option so that admin and SuperAdmin can easily find their desired data.
- `Reports` The system will generate excel reports based on various parameters, such as inventory levels, ip address, vpn list, and user list.
- `Condition and Warranty Expire Date` In Assets table, there are two columns named Condition and Warranty Expire Date which changes color according to the data for user's advantage.
- `Connection between tables` Every table is connected to each other like user list table connects with VPN table and assets table. Also, the IP address table connects with the user list table.
- `IP address management` In the IP address table, admin and super admin can add single IP addresses and also they can add a block of IP addresses.
- `Other features` There are many other features for admin, such as generating pdf of invoices for products, changing password, and managing admin creation.
- - - - -
## Demo


- - - - -
## Technology

- `Backend` Laravel PHP framework
- `Frontend` Livewire for real-time frontend development, HTML, CSS, Bootstrap, JavaScript, and AJAX
- `Database` MySQL for data storage

---
## Conclusion

This Inventory Management System will provide an efficient way for companies to manage their inventory levels and related data. The user-friendly interface and advanced features will make it easy for the admin and super admin to perform their tasks efficiently. The use of Laravel, Livewire, HTML, CSS, Bootstrap, JavaScript, and AJAX will ensure a high-performance system that is easily scalable and maintainable.
---
## Usage

This is not a package - it's a full Laravel project that you should use as a starter boilerplate, and then add your own custom functionality.

- Clone the repository with `git clone`
- Copy `.env.example` file to `.env` and edit database credentials there
- Run `composer install`
- Run `php artisan keygenerate`
- Run `php artisan migrate --seed` (it has some seeded data - see below)
- That's it launch the main URL and login with default credentials `admin@admin.com` - `password`
