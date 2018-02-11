#include "SDL2/SDL.h"

class IDrawableObject {
    public:
        virtual void draw(SDL_Renderer* renderer) = 0;
};