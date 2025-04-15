#include "oeuvres.h"

#include <QApplication>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    Oeuvres w;
    w.show();
    return a.exec();
}
