class IDrawableObject;
class DrawableObjectListItem {

    public:
        DrawableObjectListItem(IDrawableObject* iDrawableObject, DrawableObjectListItem* previous);
        DrawableObjectListItem(IDrawableObject* iDrawableObject);
        ~DrawableObjectListItem();
        IDrawableObject*  item;
        DrawableObjectListItem* next; 
        DrawableObjectListItem* previous;

        DrawableObjectListItem* getNext();
        DrawableObjectListItem* getPrevios();
};