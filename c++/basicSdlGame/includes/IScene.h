#include "SDL2/SDL.h"
#include <Game.h>
#include <DrawableObjectList.h>
class IScene {
    public: 
        DrawableObjectList* drawableList;
        virtual void handleEvents(Game* game) = 0; 
        virtual void update(Game* game) = 0; 
        virtual void draw(Game* game) = 0;
};