#include <Button.h>


Button::Button(int x, int y, int w, int h) {
    this->shape.x = x;
    this->shape.y = y;
    this->shape.w = w;
    this->shape.h = h;
}

Button::~Button() {}

void Button::draw(SDL_Renderer* renderer) {

    SDL_SetRenderDrawColor(renderer, 0, 255, 0, 255);
    SDL_RenderFillRect( renderer, &this->shape );
}

