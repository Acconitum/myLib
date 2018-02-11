#include <IDrawableObject.h>
#include <SDL2/SDL_ttf.h>

class Button: public IDrawableObject {

    public:

        SDL_Rect shape;
        TTF_Font* font;

        Button(int x, int y, int w, int h);
        ~Button();
        void draw(SDL_Renderer* renderer);

};