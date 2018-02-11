#include "SDL2/SDL.h"
#include "Game.h"
#include "iostream"

/*  
* g++ src/main.c -o bin/executablename  -I /usr/include/SDL2/ -I includes/ /usr/lib/libSDL2-2.0.so.0.7.0 lib/*
*/
int main(void) {

    Game *game = new Game();   
    int c = 0;
    while ( game->isRunning() ) {
        //std::cout << c << std::endl;
        game->run();
        //c++;
    }

    game->quit();
    
    return 0;
}