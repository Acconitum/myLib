#include <DrawableObjectListItem.h>

DrawableObjectListItem::DrawableObjectListItem(IDrawableObject* iDrawableObject, DrawableObjectListItem* previous) {
    this->item = iDrawableObject;
    this->next = nullptr;
    this->previous = previous;
}

DrawableObjectListItem::DrawableObjectListItem(IDrawableObject* iDrawableObject) {
    this->item = iDrawableObject;
    this->next = nullptr;
    this->previous = nullptr;
}

DrawableObjectListItem* DrawableObjectListItem::getNext() {
    return this->next;
}

DrawableObjectListItem* DrawableObjectListItem::getPrevios() {
    return this->previous;
}

DrawableObjectListItem::~DrawableObjectListItem() {}
