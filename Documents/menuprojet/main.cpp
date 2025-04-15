#include "menuprojet.h"

#include <QApplication>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    menuprojet w;
    w.show();
    return a.exec();
}
