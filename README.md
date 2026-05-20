```markdown
# 📚 Library Management System  
### User Manual  

**Course:** IS301 Structured Programming  
**Project Title:** Library Management System  
**Prepared by:** [Your Name / Group Members]  
**Date:** [Insert Submission Date]

---

## 📑 Table of Contents
1. Introduction  
2. System Requirements  
3. Installation and Setup  
4. User Authentication  
5. Main Menu Overview  
6. System Features  
   - Display All Books  
   - Search Book  
   - Add New Book  
   - Update Book Quantity  
   - Member Management  
   - Borrow and Return Books  
   - Generate Inventory Report  
   - Exit  
7. File Structure  
8. Error Handling  
9. Usage Guidelines  
10. Troubleshooting  
11. Conclusion  

---

## 1. Introduction
The **Library Management System (LMS)** is a console-based application designed to assist library administrators in managing books, members, and borrowing records efficiently.

The system provides the ability to:
- Maintain and organize book inventory  
- Manage library members  
- Track borrowing and returning activities  
- Generate inventory reports  

---

## 2. System Requirements

To run the application, ensure the following:

- A computer with any of the following installed:
  - C / C++ compiler (e.g., GCC)
  - Java or Python environment (depending on implementation)
- Required data files in the program directory:
  - `books.txt`
  - `members.txt` (optional)
  - `borrow.txt` (optional)

---

## 3. Installation and Setup

1. Download or copy the program files into a folder.
2. Place all required `.txt` files in the same folder.
3. Open a terminal or command prompt.
4. Navigate to the program directory.
5. Compile the program (if required):
```

gcc program.c -o library

```
6. Run the program:
```

./library

```
or on Windows:
```

library.exe

```

---

## 4. User Authentication

Upon starting the system, login is required.

**Example:**
```

Username: admin
Password: 1234

```

✅ Only authorized administrators can access the system.

---

## 5. Main Menu Overview

After successful login, the main menu is displayed:

```

\===== Library Management System =====

1. Display All Books
2. Search Book
3. Add New Book
4. Update Book Quantity
5. Manage Members
6. Borrow/Return Books
7. Generate Inventory Report
8. Exit

```

Users can select an option by entering the corresponding number.

---

## 6. System Features

### 6.1 Display All Books
Displays all available books with details:
- Book ID  
- Title  
- Author  
- Genre  
- Year Published  
- Quantity  
- Availability Status  

---

### 6.2 Search Book
Allows users to search books by:
- Title  
- Author  

✅ Matches are displayed instantly.

---

### 6.3 Add New Book
Users can add a new book by entering:
- Book ID  
- Title  
- Author  
- Genre  
- Year Published  
- Quantity  

✅ The book is saved into `books.txt`.

---

### 6.4 Update Book Quantity
- Enter Book ID  
- Enter new quantity  

✅ The system updates the record and availability status.

---

### 6.5 Member Management

#### Features:
- Register new members  
- View member details  
- Update member information  

#### Member Information Includes:
- Member ID  
- Name  
- Contact details  

---

### 6.6 Borrow and Return Books

#### Borrow Book
- Enter Member ID  
- Enter Book ID  
- System records borrowing date  

#### Return Book
- Enter Book ID  
- System records return date  
- Quantity is updated automatically  

✅ All transactions are stored in the borrowing records file.

---

### 6.7 Generate Inventory Report

Generates a file named **`inventory_report.txt`**

**Example Output:**
```

BookID: 001
Title: Programming Fundamentals
Author: John Doe
Genre: Technology
Year Published: 2015
Quantity: 10
Availability Status: Available
------------------------------

```

---

### 6.8 Exit
- Saves all data  
- Safely exits the program  

---

## 7. File Structure

### books.txt Format:
```

BookID, Title, Author, Genre, YearPublished, Quantity

```

**Example:**
```

001, C Programming, Dennis Ritchie, Technology, 1978, 5

```

---

## 8. Error Handling

The system manages errors such as:
- Missing files (`File not found`)  
- Invalid login details  
- Incorrect menu selections  
- Invalid inputs (e.g., non-numeric values)  
- Book not found  

✅ User-friendly error messages are displayed.

---

## 9. Usage Guidelines

- Always enter correct **Book ID** when updating records  
- Keep all `.txt` files in the same directory  
- Generate reports periodically  
- Exit the system properly to save data  

---

## 10. Troubleshooting

| Issue | Solution |
|------|---------|
| Program fails to run | Check compiler installation |
| Missing file error | Ensure required `.txt` files exist |
| Login not working | Verify username and password |
| Data not saved | Exit properly using option 8 |

---

## 11. Conclusion

The Library Management System demonstrates the application of structured programming concepts including:
- Modular design  
- File handling  
- Data management  
- User interaction  

It provides an efficient and reliable tool for managing library operations in a simple console environment.

