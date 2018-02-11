#include "Game.h"

Game::Game() {
    this->initSDL();
    this->running = true;
    //this->name = "Testing around";

    this->createWindow(); 
    this->createRenderer(); 
}

Game::~Game() {}

void Game::handleEvents() {
    
    SDL_Event event;

    while(SDL_PollEvent(&event)) {
        switch(event.type) {
            case SDL_QUIT: 
                this->running = false;
                break;
        }
    }
}

void Game::update() {

   
}

void Game::draw() { 

    SDL_Rect rect;
    rect.x = 50;
    rect.y = 50;
    rect.w = 20;
    rect.h = 20;
    SDL_SetRenderDrawColor(this->renderer, 0, 0, 0, 255);

    SDL_RenderClear(this->renderer);
    SDL_SetRenderDrawColor(this->renderer, 0, 255, 0, 255);
    
    SDL_RenderFillRect( this->renderer, &rect );

    SDL_RenderPresent(this->renderer);
    //SDL_Delay(100);
}

void Game::run() {

    this->handleEvents();    
    this->update();
    this->draw();
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
    //SDL_SetRenderDrawBlendMode(this->renderer, SDL_BLENDMODE_BLEND);
}

void Game::initSDL() {
    SDL_Init(SDL_INIT_VIDEO);   // Initialize SDL2
}

bool Game::isRunning() {
    return this->running;
}

