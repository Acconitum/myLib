#ifndef _GAME
#define _GAME

#include "iostream"
#include "SDL2/SDL.h"
#include <string>

class Game {

    protected:
        bool running;
        //const char* name;

        SDL_Window *window;        // Declare a pointer to an SDL_Window
        SDL_Renderer *renderer; 
        
        void initSDL();
        void createWindow();
        void createRenderer();
        void handleEvents();
        void update();
        void draw();

    public:
        Game();
        ~Game();

        bool isRunning();
        void run();
        void quit();
};

#endif