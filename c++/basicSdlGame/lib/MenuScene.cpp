#include <MenuScene.h>
#include "iostream"


MenuScene::MenuScene() {
    this->drawableList = new DrawableObjectList();
    Button *button1 = new Button(150, 50, 300, 60);
    Button *button2 = new Button(150, 150, 300, 60);
    Button *button3 = new Button(150, 250, 300, 60);
    this->drawableList->add(button1);
    this->drawableList->add(button2);
    this->drawableList->add(button3);
}

MenuScene::~MenuScene() {
    
}

void MenuScene::handleEvents(Game* game) {
    SDL_Event event;

    while(SDL_PollEvent(&event)) {
        switch(event.type) {
            case SDL_QUIT: 
                game->running = false;
                break;
        }
    }
}

void MenuScene::update(Game* game) {
    
}

void MenuScene::draw(Game* game) {
    //SDL_Rect rect;
    //rect.x = 50;
    //rect.y = 50;
    //rect.w = 20;
    //rect.h = 20;
    
    SDL_SetRenderDrawColor(game->renderer, 0, 0, 0, 255);
    SDL_RenderClear(game->renderer);
    
    DrawableObjectListItem* actualItem = nullptr;
    do {

        if (actualItem == nullptr) {
            actualItem = this->drawableList->getFirst();
        } else {
            actualItem = actualItem->getNext();
        }

        actualItem->item->draw(game->renderer);

    } while (actualItem->getNext() != nullptr);


    SDL_RenderPresent(game->renderer);
}
