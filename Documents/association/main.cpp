#include "association.h"

#include <QApplication>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);
    Association w;
    w.show();
    return a.exec();
}
