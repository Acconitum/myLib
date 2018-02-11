#ifndef GAME
#define GAME

#include "iostream"
#include "SDL2/SDL.h"
#include <string>

// Preprocessor directive 
// tells the Game class that ther will be an IScene class defined
class IScene;

class Game {

    protected:

        //const char* name;
    
        IScene* scene;
        
        void initSDL();
        void createWindow();
        void createRenderer();

    public:
        Game();
        ~Game();

        bool running;
        SDL_Window* window;        // Declare a pointer to an SDL_Window
        SDL_Renderer* renderer;

        bool isRunning();
        void run();
        void quit();
};

#endif