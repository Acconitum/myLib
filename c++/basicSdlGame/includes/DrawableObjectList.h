#include <DrawableObjectListItem.h>

class DrawableObjectList {
    public:
        DrawableObjectListItem* first;
        DrawableObjectListItem* last;

        DrawableObjectList();
        ~DrawableObjectList();
        
        DrawableObjectListItem* getFirst();
        DrawableObjectListItem* getLast();
        void add(IDrawableObject* objectToAdd);
        void remove(IDrawableObject* objectToRemove);
};