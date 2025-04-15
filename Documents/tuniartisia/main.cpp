#include "tuniartisia.h"

#include <QApplication>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    tuniartisia w;
    w.show();
    return a.exec();
}
