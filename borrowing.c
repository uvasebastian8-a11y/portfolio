#include <stdio.h>
#include <string.h>
#include <time.h>
#include "borrowing.h"
#include "books.h"
#include "members.h"

// External references to data stored in other modules
extern struct Book books[];
extern int bookCount;

// Simple structure to track transaction history in memory
struct Transaction {
    char bookID[10];
    int memberID;
    char date[20];
    char type[10]; // "Issue" or "Return"
};

struct Transaction history[500];
int historyCount = 0;

// Helper function to get current system date
void getCurrentDate(char *dateStr) {
    time_t t = time(NULL);
    struct tm tm = *localtime(&t);
    sprintf(dateStr, "%d-%02d-%02d", tm.tm_year + 1900, tm.tm_mon + 1, tm.tm_mday);
}

void issueBook() {
    char bID[10];
    int mID;
    
    printf("\n--- Issue Book ---\n");
    printf("Enter Member ID: ");
    scanf("%d", &mID);
    printf("Enter Book ID: ");
    scanf("%s", bID);

    // Find the book in the inventory [cite: 92, 93]
    for (int i = 0; i < bookCount; i++) {
        if (strcmp(books[i].id, bID) == 0) {
            if (books[i].quantity > 0) {
                // Update inventory and frequency 
                books[i].quantity--;
                books[i].borrowCount++; 
                
                // Record transaction [cite: 206]
                strcpy(history[historyCount].bookID, bID);
                history[historyCount].memberID = mID;
                strcpy(history[historyCount].type, "ISSUE");
                getCurrentDate(history[historyCount].date);
                historyCount++;

                printf("Success: Book '%s' issued to Member %d.\n", books[i].title, mID);
                return;
            } else {
                printf("Error: Book is currently out of stock.\n");
                return;
            }
        }
    }
    printf("Error: Book ID %s not found. Please enter a valid Book ID and Member ID\n", bID);
}

void returnBook() {
    char bID[10];
    int mID;

    printf("\n--- Return Book ---\n");
    printf("Enter Member ID: ");
    scanf("%d", &mID);
    printf("Enter Book ID: ");
    scanf("%s", bID);

    for (int i = 0; i < bookCount; i++) {
        if (strcmp(books[i].id, bID) == 0) {
            books[i].quantity++; // Restore inventory 
            
            // Record transaction [cite: 206]
            strcpy(history[historyCount].bookID, bID);
            history[historyCount].memberID = mID;
            strcpy(history[historyCount].type, "RETURN");
            getCurrentDate(history[historyCount].date);
            historyCount++;

            printf("Success: Book '%s' returned by Member %d.\n", books[i].title, mID);
            return;
        }
    }
    printf("Error: Transaction record not found. Please enter the Valid Book ID and Member ID.\n");
}

void borrowingHistory() {
    printf("\n--- Borrowing History ---\n");
    printf("%-10s %-12s %-10s %-10s\n", "Date", "Type", "BookID", "MemberID");
    printf("--------------------------------------------\n");
    for (int i = 0; i < historyCount; i++) {
        printf("%-10s %-12s %-10s %-10d\n", 
               history[i].date, history[i].type, history[i].bookID, history[i].memberID);
    }
}

void manageBorrowing() {
    int choice;
    do {
        printf("-----------------------------\n");
        printf("----\nBorrowing Records -----\n");
        printf("-----------------------------\n");
        printf("-   1. Issue Book           -\n");
        printf("-   2. Return Book          -\n");
        printf("-   3. View History         -\n");
        printf("-   0. Exit                 -\n");
        printf("-----------------------------\n");
        printf("                             \n");
        printf(" Enter choice: ");
        scanf("%d", &choice);

        switch(choice) {
            case 1: issueBook(); break;
            case 2: returnBook(); break;
            case 3: borrowingHistory(); break;
            case 0: break;
            default: printf("Invalid choice! Please select the correct choice\n");
        }
    } while(choice != 0);
}
