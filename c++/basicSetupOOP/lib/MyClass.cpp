#include "MyClass.h"

MyClass::MyClass(int number, std::string newString) {
    this->number = number;
    this->myString = newString;
}
MyClass::~MyClass() {}

int MyClass::getInt() {
    return this->number;
}


void MyClass::setInt(int newInt) {
    this->number = newInt;
}

std::string MyClass::getString() {
    return this->myString;
}

void MyClass::setString(std::string newString) {
    this->myString = newString;
}