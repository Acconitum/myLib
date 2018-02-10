#ifndef _MY_CLASS
#define _MY_CLASS

#include "iostream"
#include <stdio.h>
#include <string>

class MyClass {

    protected:
        int number;
        std::string myString;

    public:
        MyClass(int number, std::string newString);
        ~MyClass();
        
        std::string getString();
        void setString(std::string newString);

        int getInt();
        void setInt(int newInt);
};

#endif