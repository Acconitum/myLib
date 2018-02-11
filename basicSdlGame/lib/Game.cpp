#include <Game.h>
#include <MenuScene.h>


Game::Game() {
    
    this->running = true;
    //this->name = "Testing around";
    
    this->initSDL();

    this->createWindow(); 
    this->createRenderer();
    
    this->scene = new MenuScene();    
}

Game::~Game() {}

void Game::run() {
        
    scene->handleEvents(this);    
    scene->update(this);
    scene->draw(this);
}

void Game::quit() {
    
    SDL_DestroyWindow(this->window); 
    SDL_DestroyRenderer(this->renderer); 

    SDL_Quit(); 
    std::cout << "Game quitted\n";
}

void Game::createWindow() {

    this->window = SDL_CreateWindow( 
        "Testing around",                   //    window title
        SDL_WINDOWPOS_UNDEFINED,            //    initial x position
        SDL_WINDOWPOS_UNDEFINED,            //    initial y position
        640,                                //    width, in pixels
        480,                                //    height, in pixels
        SDL_WINDOW_SHOWN|SDL_WINDOW_OPENGL  //    flags - see below
    );

    if(this->window==NULL){   
        // In case that the window could not be created...
        std::cout << "Could not create window: " << SDL_GetError() << '\n';
        this->running = false;
    }
}

void Game::createRenderer() {

    this->renderer = SDL_CreateRenderer(this->window, -1, SDL_RENDERER_ACCELERATED);

    if(this->renderer==NULL){   

        std::cout << "Could not create renderer: " << SDL_GetError() << '\n';
        this->running = false;
    }    
}

void Game::initSDL() {
    SDL_Init(SDL_INIT_VIDEO);   // Initialize SDL2
}

bool Game::isRunning() {
    return this->running;
}

