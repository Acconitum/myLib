#include "MyClass.h"
#include "iostream"

/*  compile this by typing "g++ src/main.c -o bin/executable -I includes/ lib/MyClass.cpp" in terminal
    src/main.c is the source file
    -o bin/executable compiled programm target file
    lib/MyClass.cpp as an argument to be compiled aswell 
    can be lib/*.cpp aswell
*/
int main(void) {
    MyClass *test = new MyClass(2, "Marc");
    std::cout << test->getInt() << std::endl;
    std::cout << test->getString() << std::endl;
    test->setString("Miranda");
    std::cout << test->getString() << std::endl;
    return 0;
}