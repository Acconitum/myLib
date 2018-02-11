#include <IScene.h>
#include <Button.h>
class MenuScene: public IScene {
    public:

        DrawableObjectList* drawableList;

        MenuScene();
        ~MenuScene();

        void handleEvents(Game* game);
        void update(Game* game);
        void draw(Game* game);
};
