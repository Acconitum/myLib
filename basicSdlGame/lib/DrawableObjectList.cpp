#include <DrawableObjectList.h>
#include "iostream"

DrawableObjectList::DrawableObjectList() {
    this->first = nullptr;
    this->last = nullptr;
}

DrawableObjectList::~DrawableObjectList() {}


DrawableObjectListItem* DrawableObjectList::getFirst() {
    return this->first;
}

DrawableObjectListItem* DrawableObjectList::getLast() {
    return this->last;    
}

void DrawableObjectList::add(IDrawableObject* objectToAdd) {
    
    if (this->first != nullptr) {
        DrawableObjectListItem* newItem = new DrawableObjectListItem(objectToAdd, this->getLast());
        this->getLast()->next = newItem;
        this->last = newItem;

    } else {
        DrawableObjectListItem* newItem = new DrawableObjectListItem(objectToAdd);
        this->first = newItem;
        this->last = newItem;
    }
}

void DrawableObjectList::remove(IDrawableObject* objectToRemove) {

}